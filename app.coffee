http = require("http")
connect = require("connect")
fs = require("fs")
url = require('url')

promos = JSON.parse(fs.readFileSync('./promo.json', 'utf8'))

app = connect()
  .use(connect.json())
  .use(connect.bodyParser())
  .use(connect.favicon())
  .use(connect.static("./frontend/build"))
  .use("/list", (req, res, next) ->
    res.end(JSON.stringify(promos));
  )
  .use("/add", (req, res, next) ->
    if "POST" is req.method
      id = new Date().getTime()
      if req.body.name and req.body.message and req.body.type in ['sale','promo']
        promos.list.push
          id: id,
          name: req.body.name.toLocaleLowerCase()
          message: req.body.message
          type: req.body.type.toLocaleLowerCase()
        fs.writeFileSync('./promo.json', JSON.stringify(promos))

      res.end(id+'');
    else
      next()
  )
  .use("/remove", (req, res, next) ->
    if "POST" is req.method
      promos.list = promos.list.filter (p) -> p.id != req.body.id
      fs.writeFileSync('./promo.json', JSON.stringify(promos))
      res.end('true');
    else
      next()
  )
  .use("/find", (req, res, next) ->
    name = unescape(req.url)
    if ('/' == name[0])
      name = name.slice(1).toLocaleLowerCase()
    res.end(JSON.stringify(promos.list.filter (p) -> p.name == name));
  )
  .use((err, req, res, next) ->
    res.statusCode = err.status  if err.status
    res.statusCode = 500  if res.statusCode < 400
    res.setHeader "Content-Type", "text/html; charset=utf-8"
    res.end "Error!"
  )

port = process.env.PORT or 8020
http.createServer(app).listen port