const fs = require("fs");
const { ethers } = require("ethers");

// ambil private key
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

// format message
const message =
    `X1 AuthMessage, Address ${wallet.address.toLowerCase()}`;

// simpan ke file
fs.writeFileSync("signmsg.txt", message);

// output
console.log(" • Sign Success");
