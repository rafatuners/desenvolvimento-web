const puppeteer = require('puppeteer');

async function getDeals() {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();
    await page.goto('https://sale.aliexpress.com/__pc/global_selection_pc.htm');

    const deals = await page.evaluate(() => {
        const dealNodes = document.querySelectorAll('.JIIxO');
        return Array.from(dealNodes).map(deal => ({
            title: deal.querySelector('._9lUaP').innerText,
            link: deal.querySelector('a').href,
        }));
    });

    await browser.close();
    return deals;
}

async function generateAffiliateLinks(deals) {
    // Substitua 'YOUR_TAG' pelo seu identificador de afiliado
    const affiliateTag = 'xxdarkshotxx';

    return deals.map(deal => ({
        title: deal.title,
        link: `${deal.link}?tag=${affiliateTag}`,
    }));
}

getDeals().then(deals => {
    const affiliateLinks = generateAffiliateLinks(deals);
    console.log(affiliateLinks);
});
