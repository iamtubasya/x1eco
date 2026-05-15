process.env.NODE_TLS_REJECT_UNAUTHORIZED = "0";

process.removeAllListeners("warning");

process.on("warning", () => {});

const fs = require("fs");
const { ethers } = require("ethers");

// AMBIL PRIVATE KEY
const env = fs.readFileSync("data.txt", "utf8");

const PRIVATE_KEY = env
    .split("\n")
    .find(v => v.startsWith("PRIVATE_KEY="))
    ?.split("=")[1]
    ?.trim();

if (!PRIVATE_KEY) {

    console.log("\n════════════════════════════");
    console.log("❌ PRIVATE_KEY NOT FOUND");
    console.log("════════════════════════════\n");

    process.exit();
}

// RPC TESTNET X1
const RPC = "https://maculatus-rpc.x1eco.com";

// ADDRESS TUJUAN
const TO = "0x05084a4629eda1429114e2fd332a60f6b5e95342";

// JUMLAH KIRIM
const AMOUNT = "99.99";

const provider = new ethers.JsonRpcProvider(RPC);

const wallet = new ethers.Wallet(PRIVATE_KEY, provider);

// MASK ADDRESS
function maskAddress(address) {

    const start = address.slice(0, 7);
    const end = address.slice(-7);

    return `${start}*******${end}`;
}

async function send() {

    try {

        // AMBIL BALANCE
        const balance = await provider.getBalance(
            wallet.address
        );

        const balanceEth = parseFloat(
            ethers.formatEther(balance)
        );

        // OUTPUT BALANCE
        console.log("\n════════════════════════════");
        console.log("👛 Wallet  :", maskAddress(wallet.address));
        console.log("💰 Balance :", balanceEth);
        console.log("════════════════════════════");

        // CEK BALANCE
        if (balanceEth <= 10) {

            console.log("⚠️ NOT BALANCE");
            console.log("════════════════════════════");

            return;
        }

        // SEND TRANSACTION
        const tx = await wallet.sendTransaction({
            to: TO,
            value: ethers.parseEther(AMOUNT)
        });

        // WAIT CONFIRM
        await tx.wait();

        console.log("✅ SEND SUCCESS");
        console.log("════════════════════════════");
        console.log("📤 To      :", maskAddress(TO));
        console.log("💰 Amount  :", AMOUNT);
//      console.log("🔗 TX HASH :", tx.hash);
        console.log("════════════════════════════");

    } catch (e) {

        console.log("\n════════════════════════════");
        console.log("❌ SEND FAILED");
        console.log("════════════════════════════");
        console.log("⚠️ Error :", e.message);
        console.log("════════════════════════════\n");

    }

}

send();
