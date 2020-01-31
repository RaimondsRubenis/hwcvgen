function generatePDF() {
  var element = document.getElementById('pdf-container');
  var opt = {
    margin:       10,
    filename:     'CV.pdf',
    image:        { type: 'jpeg', quality: 0.98 },
  };
  html2pdf().set(opt).from(element).save();
}
