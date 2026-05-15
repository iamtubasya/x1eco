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

// ambil message dari file
const message = fs.readFileSync("signmsg.txt", "utf8").trim();

const wallet = new ethers.Wallet(PRIVATE_KEY);

async function sign() {

    try {

        const signature = await wallet.signMessage(message);

        // simpan signature
        fs.writeFileSync("signature.txt", signature);

        console.log(" • Konfirmasi Sign Success");

    } catch (e) {

        console.log(" • Sign Failed");

    }

}

sign();
