const fs = require("fs");
const { ethers } = require("ethers");

const env = fs.readFileSync("data.txt", "utf8");

const PRIVATE_KEY = env
    .split("\n")
    .find(v => v.startsWith("PRIVATE_KEY="))
    ?.split("=")[1]
    ?.trim();

if (!PRIVATE_KEY) {
    console.log("PRIVATE KEY tidak ditemukan");
    process.exit();
}

const wallet = new ethers.Wallet(PRIVATE_KEY);

const message =
    `X1 AuthMessage, Address ${wallet.address.toLowerCase()}`;

fs.writeFileSync("signmsg.txt", message);

console.log(" • Sign Success");
