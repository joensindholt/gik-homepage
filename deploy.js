var FtpDeploy = require("ftp-deploy");
var ftpDeploy = new FtpDeploy();

var config = {
  user: process.env.DEPLOY_FTP_USERNAME,
  password: process.env.DEPLOY_FTP_PASSWORD,
  host: "ftp.gentofte-ik.dk",
  port: 21,
  localRoot: __dirname + "/wordpress/gik-theme",
  remoteRoot: "/wp-content/themes/gik-theme",
  include: ["*", "**/*"],
  exclude: ["*.ts"],
  deleteRemote: false,
  forcePasv: true
};

ftpDeploy
  .deploy(config)
  .then(res => console.log("finished:", res))
  .catch(err => console.log(err));
