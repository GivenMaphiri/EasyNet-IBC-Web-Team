function generatePDF() {
    var pdfObject = jsPDFInvoiceTemplate.default(props);
    console.log("Object created: ", pdfObject);
}

var props = {
    outputType: jsPDFInvoiceTemplate.OutputType.Save,
    onJsPDFDocCreation?: (jsPDFDoc: jsPDF) => void //Allows for additional configuration prior to writing among others, adds support for different languages and symbols
    returnJsPDFDocObject: true,
    fileName: "Invoice 2021",
    orientationLandscape: false,
    compress: true,
    logo: {
        src: "_images/_logos/easynet.png",
        type: 'PNG', //optional, when src= data:uri (nodejs case)
        width: 35.33, //aspect ratio = width/height
        height: 26.66,
        margin: {
            top: 0, //negative or positive num, from the current position
            left: 0 //negative or positive num, from the current position
        }
    },
    stamp: {
        inAllPages: true, //by default = false, just in the last page
        src: "https://raw.githubusercontent.com/edisonneza/jspdf-invoice-template/demo/images/qr_code.jpg",
        type: 'JPG', //optional, when src= data:uri (nodejs case)
        width: 20, //aspect ratio = width/height
        height: 20,
        margin: {
            top: 0, //negative or positive num, from the current position
            left: 0 //negative or positive num, from the current position
        }
    },
    business: {
        name: "EasyNet In Business Communications",
        address: "570 Fehrsen Street, Brooklyn, Pretoria",
        phone: "012 433 6486",
        email: "sales@easynetbusiness.co.za",
        email_1: "dikeledi@easynetbusiness.co.za",
        website: "easynetbusiness.co.za",
    },
    contact: {
        label: "Invoice issued for:",
        name: shippingInfo.shipping_name,
        address: shippingInfo.shipping_street,
        phone: shippingInfo.shipping_phone.toString(),
    },
    invoice: {
        label: "Invoice #: ",
        num: 19,
        invDate: "Payment Date: 01/01/2021 18:12",
        invGenDate: "Invoice Date: 02/02/2021 10:17",
        headerBorder: false,
        tableBodyBorder: false,
        header: [{
                title: "#",
                style: {
                    width: 10
                }
            },
            {
                title: "Title",
                style: {
                    width: 80
                }
            },
            {
                title: "Price"
            },
            {
                title: "Quantity"
            },
            {
                title: "Total"
            }
        ],
        table: Array.from(Array(10), (item, index) => ([
            index + 1,
            "There are many variations ",
            200.5,
            4.5,
            400.5
        ])),
        additionalRows: [{
                col1: 'Total:',
                col2: '145,250.50',
                col3: 'ALL',
                style: {
                    fontSize: 13 //optional, default 12
                }
            },
            {
                col1: 'VAT:',
                col2: '20',
                col3: '%',
                style: {
                    fontSize: 11 //optional, default 12
                }
            },
            {
                col1: 'SubTotal:',
                col2: '116,199.90',
                col3: 'ALL',
                style: {
                    fontSize: 11 //optional, default 12
                }
            }
        ],
        invDescLabel: "Invoice Note",
        invDesc: "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary.",
    },
    footer: {
        text: "The invoice is created on a computer and is valid without the signature and stamp.",
    },
    pageEnable: true,
    pageLabel: "Page ",
};