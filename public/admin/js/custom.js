function maxFileSizeControl(file,fileName='Resim',maxSize=2) {
    const data= {
        type:null,
        size:null,
    };
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB']
    if (file.files[0].size === 0) return data;
    const i = parseInt(Math.floor(Math.log(file.files[0].size) / Math.log(1024)), 10)
    if (i === 0){
        data.size= file.files[0].size;
        data.type=sizes[i];
    }
    data.size=(file.files[0].size / (1024 ** i)).toFixed(1);
    data.type=sizes[i];

    if (['Bytes', 'KB', 'MB'].includes(data.type) && ((data.type=='MB' && data.size<maxSize) || data.type!='MB')) {
        /*Swal.fire({
            icon: 'info',
            title: 'Bilgi',
            text: `${image.files[0].name} dosyasının boyutunda sıkıntı yok.`,
        })*/
        return true;
    }else{
        Swal.fire({
            icon: 'error',
            title: 'HATA',
            text: `${fileName} maksimum ${maxSize}MB olabilir.`,
            //text: `${fileName ? fileName+' resminin' : 'Resmin'} boyutu ${maxSize}MB den büyük olamaz!`,
            //text: `${image.files[0].name} dosyasının boyutu ${maxSize}MB den büyük olamaz!`,
        })
        return false;
    }
}

function fileMaxSizeControl(file,fileName='Resim',maxSize=2) {
    const data= {
        type:null,
        size:null,
    };
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB']
    if (file.size === 0) return data;
    const i = parseInt(Math.floor(Math.log(file.size) / Math.log(1024)), 10)
    if (i === 0){
        data.size= file.size;
        data.type=sizes[i];
    }
    data.size=(file.size / (1024 ** i)).toFixed(1);
    data.type=sizes[i];

    if (['Bytes', 'KB', 'MB'].includes(data.type) && ((data.type=='MB' && data.size<maxSize) || data.type!='MB')) {
        /*Swal.fire({
            icon: 'info',
            title: 'Bilgi',
            text: `${image.files[0].name} dosyasının boyutunda sıkıntı yok.`,
        })*/
        return true;
    }else{
        Swal.fire({
            icon: 'error',
            title: 'HATA',
            text: `${fileName} maksimum ${maxSize}MB olabilir.`,
            //text: `${fileName ? fileName+' resminin' : 'Resmin'} boyutu ${maxSize}MB den büyük olamaz!`,
            //text: `${image.files[0].name} dosyasının boyutu ${maxSize}MB den büyük olamaz!`,
        })
        return false;
    }
}


function maxBlobSizeControl(file,fileName,maxSize=2) {
    const data= {
        type:null,
        size:null,
    };

    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB']
    if (file.size === 0) return data;
    const i = parseInt(Math.floor(Math.log(file.size) / Math.log(1024)), 10)
    if (i === 0){
        data.size= file.size;
        data.type=sizes[i];
    }
    data.size=(file.size / (1024 * 1024 * i)).toFixed(1);
    data.type=sizes[i];

    if (['Bytes', 'KB', 'MB'].includes(data.type) && ((data.type=='MB' && data.size<maxSize) || data.type!='MB')) {
        return true;
    }else{
        Swal.fire({
            icon: 'warning',
            title: 'HATA',
            text: `${fileName} maksimum ${maxSize}MB olabilir. Resmi daha ufak şekilde kırpabilir veya tamamının boyutunu azaltıp tekrar yüklemeyeyi deneyebilirsiniz...`,
            confirmButtonText: 'Kapat',
            //text: `${fileName ? fileName+' resminin' : 'Resmin'} boyutu ${maxSize}MB den büyük olamaz!`,
            //text: `${image.files[0].name} dosyasının boyutu ${maxSize}MB den büyük olamaz!`,
        })
        return false;
    }
}


/**
 * Convert a base64 string in a Blob according to the data and contentType.
 *
 * @param b64Data {String} Pure base64 string without contentType
 * @param contentType {String} the content type of the file i.e (image/jpeg - image/png - text/plain)
 * @param sliceSize {Int} SliceSize to process the byteCharacters
 * @return Blob
 */
function b64toBlob(b64Data, contentType, sliceSize) {
    contentType = contentType || '';
    sliceSize = sliceSize || 512;

    var byteCharacters = atob(b64Data);
    var byteArrays = [];

    for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        var slice = byteCharacters.slice(offset, offset + sliceSize);

        var byteNumbers = new Array(slice.length);
        for (var i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }

        var byteArray = new Uint8Array(byteNumbers);

        byteArrays.push(byteArray);
    }

    var blob = new Blob(byteArrays, {type: contentType});
    return blob;
}

