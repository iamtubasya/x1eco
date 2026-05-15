const fs = require("fs");
const { HDNodeWallet } = require("ethers");

const mnemonic = "REPLACEPHARSE";

const total = 5000;

let output = "";

for (let i = 0; i < total; i++) {

  const path = `m/44'/60'/0'/0/${i}`;

  const wallet = HDNodeWallet.fromPhrase(
    mnemonic,
    undefined,
    path
  );

  output += `pkey:${wallet.privateKey}\n`;

  // output satu satu
  console.log(`Save privatekey ${i + 1}/${total}`);
}

fs.writeFileSync("privatekey.txt", output);

console.log("Saved -> privatekey.txt");
