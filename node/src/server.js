const jsonServer = require("json-server");
const server = jsonServer.create();
const router = jsonServer.router("db.json");
const middlewares = jsonServer.defaults();

router.render = (req, res) => {
  let headersToExpose = ["Authorization"];
  let currentExposedHeaders = res.getHeader("Access-Control-Expose-Headers");

  if (currentExposedHeaders) {
    res.header(
      "Access-Control-Expose-Headers",
      headersToExpose.concat(currentExposedHeaders.split(",")).join(",")
    );
  } else {
    res.header("Access-Control-Expose-Headers", headersToExpose.join(","));
  }

  res.send(res.locals.data);
};

//default json-server middlewares
server.use(middlewares);

server.use((req, res, next) => {
  //res.header('Authorization', 'Bearer 2ee636c8-06b6-474b-b562-f1cde69ea575');
  res.setHeader("Access-Control-Allow-Origin", "*");
  res.setHeader(
    "Access-Control-Allow-Methods",
    "GET, POST, OPTIONS, PUT, PATCH, DELETE"
  );
  res.setHeader(
    "Access-Control-Allow-Headers",
    "X-Requested-With,content-type"
  );
  res.setHeader("Access-Control-Allow-Credentials", true);
  next();
});

server.use(router);
server.listen(3000, () => {
  console.log("JSON Server is running");
});
