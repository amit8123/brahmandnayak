const PAGE_HEIGHT = 916;
const PAGE_WIDTH = 1280;
let ReportFileName = 'Report';
const content = [];

function getPngDimensions(base64) {
    const header = atob(base64.slice(22, 70)).slice(16, 24);
    const uint8 = Uint8Array.from(header, c => c.charCodeAt(0));
    const dataView = new DataView(uint8.buffer);

    return {
        width: dataView.getInt32(0),
        height: dataView.getInt32(4)
    };
}

const splitImage = (img, content,  callback) => () => {

    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    const printHeight = img.height * PAGE_WIDTH / img.width;

    canvas.width = PAGE_WIDTH;

    for (let pages = 0; printHeight > pages * PAGE_HEIGHT; pages++) {
        /* Don't use full height for the last image */
        canvas.height = Math.min(PAGE_HEIGHT, printHeight - pages * PAGE_HEIGHT);
        ctx.drawImage(img, 0, -pages * PAGE_HEIGHT, canvas.width, printHeight);
        content.push({
            image: canvas.toDataURL(),
            width: 800,
        });
    }

    if (typeof callback == "function")
        callback()
};

$(document).on('click', "#report-download", function () {
    html2canvas(document.getElementById('data-table'), {
        onrendered: function (canvas) {
            var imageData = canvas.toDataURL();
            const {width, height} = getPngDimensions(imageData);
            const printHeight = height * PAGE_WIDTH / width;

            if (printHeight > PAGE_HEIGHT) {
                const img = new Image();
                img.onload = splitImage(img, content, function callMe(){
                    downloadNow()
                });
                img.src = imageData;
            } else {
                content.push({
                    image: canvas.toDataURL(),
                    width: 800,
                });

                downloadNow()
            }
        }
    });
});

function downloadNow(){
    var docDefinition = {
        pageOrientation: 'landscape',
        pageMargins: 10,
        content: content
    };
    pdfMake.createPdf(docDefinition).download(ReportFileName+" - " + Date.now() + ".pdf");
}