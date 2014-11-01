http = require("http")
connect = require("connect")


app = connect()
  .use(connect.json())
  .use(connect.bodyParser())
  .use(connect.favicon())
  .use(connect.static("./frontend/build"))
  .use("/generate", (req, res, next) ->
    if "POST" is req.method
      generateGeometry res
    else
      next()
  )
  .use("/save", (req, res, next) ->
    if "POST" is req.method and req.body.geometry
      saveGeometry req, res
    else
      next()
  )
  .use("/load", (req, res, next) ->
    if "POST" is req.method and req.body.id
      loadGeometry req, res
    else
      next()
  )
  .use((err, req, res, next) ->
    res.statusCode = err.status  if err.status
    res.statusCode = 500  if res.statusCode < 400
    res.setHeader "Content-Type", "text/html; charset=utf-8"
    res.end "Error!"
  )

port = process.env.PORT or 8020
http.createServer(app).listen port