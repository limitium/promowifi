# config valid only for Capistrano 3.1
lock '3.3.5'

set :application, 'loc2me'
set :repo_url, 'git@github.com:limitium/promowifi.git'

# Default branch is :master
# ask :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }.call

# Default deploy_to directory is /var/www/my_app
set :deploy_to, '/var/loc2me'

# Default value for :scm is :git
set :scm, :git

# Default value for :format is :pretty
# set :format, :pretty

# Default value for :log_level is :debug
# set :log_level, :debug

# Default value for :pty is false
set :pty, true

# Default value for :linked_files is []
# set :linked_files, %w{config/database.yml}

# Default value for linked_dirs is []
# set :linked_dirs, %w{bin log tmp/pids tmp/cache tmp/sockets vendor/bundle public/system}

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for keep_releases is 5
# set :keep_releases, 5

set :user, ask('login:', nil)
set :use_sudo, true
set :ssh_options, {:forward_agent => true}
set :password, ask('password:', nil)

server 'loc2me.cloudapp.net', :user => fetch(:user), :password => fetch(:password), :roles => %w{web}
namespace :deploy do

  after :updating, :copy_web do
    on roles(:web) do
      upload! "./backend/web/components", "#{release_path}/backend/web", :recursive => true
      upload! "./backend/web/css", "#{release_path}/backend/web", :recursive => true
      upload! "./backend/web/font", "#{release_path}/backend/web", :recursive => true
      upload! "./backend/web/js", "#{release_path}/backend/web", :recursive => true
    end
  end

  after :updating, :copy_config do
    on roles(:web) do
      upload! "./backend/app/config", "#{release_path}/backend/app", :recursive => true
    end
  end

  after :copy_config, :copy_config_param do
    on roles(:web) do
      upload! "./backend/app/config/parameters.yml", "#{release_path}/backend/app/config/parameters.yml.dist"
    end
  end

  after :updated, :composer_install do
    on roles(:web) do
      execute "curl -sS https://getcomposer.org/installer | php -- --install-dir=#{release_path}/backend"
      execute "cd #{release_path}/backend;php #{release_path}/backend/composer.phar update;export SYMFONY_ENV=prod; php #{release_path}/backend/composer.phar install --prefer-dist --no-dev --optimize-autoloader"
    end
  end

  after :updated, :clean_web do
    on roles(:web) do
      execute "rm -rf #{release_path}/frontend"
    end
  end

  after :updated, :clear_cache do
    on roles(:web) do
#      execute "php #{release_path}/backend/app/console doctrine:cache:clear-metadata"
#      execute "php #{release_path}/backend/app/console doctrine:cache:clear-query"
#      execute "php #{release_path}/backend/app/console doctrine:cache:clear-result"
      execute "php #{release_path}/backend/app/console cache:clear --env=prod --no-debug"
    end
  end

  after :clear_cache, :assetic_dump do
    on roles(:web) do
      execute "php #{release_path}/backend/app/console assetic:dump --env=prod --no-debug"
    end
  end



  after :clear_cache, :change_www_owner do
    on roles(:web) do
      execute "sudo /bin/chmod -R o+rw #{release_path}/.."
    end
  end

  after :change_www_owner, :restart_fpm do
    on roles(:web) do
      execute "sudo /usr/sbin/service php5-fpm restart"
    end
  end
end