// Create a new page for reference sites
const pages = figma.root.children;
let refPage = pages.find(p => p.name === "参考サイト");
if (!refPage) {
  refPage = figma.createPage();
  refPage.name = "参考サイト";
}
await figma.setCurrentPageAsync(refPage);

const b64 = "REPLACE_B64";

const decoded = figma.base64Decode(b64);
const image = figma.createImage(decoded);

const frame1 = figma.createFrame();
frame1.name = "参考サイト1: 天王寺やすえ消化器内科・内視鏡クリニック";
frame1.resize(1440, 900);
frame1.x = 0;
frame1.y = 0;
frame1.fills = [{
  type: 'IMAGE',
  scaleMode: 'FILL',
  imageHash: image.hash
}];

await figma.loadFontAsync({ family: "Inter", style: "Semi Bold" });
const label1 = figma.createText();
label1.fontName = { family: "Inter", style: "Semi Bold" };
label1.characters = "参考サイト1: tennoji-naishikyo.com";
label1.fontSize = 24;
label1.x = 0;
label1.y = -50;

return { createdNodeIds: [frame1.id, label1.id], pageId: refPage.id };
