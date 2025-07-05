function ImagePriviewInsert(my_id,my_class,message) {
    const picture__input = document.querySelector("#"+my_id);
    const pictureImage = document.querySelector("."+my_class);
    const pictureImageTxt = message;
    pictureImage.innerHTML = pictureImageTxt;

    picture__input.addEventListener("change", function(e) {
        const inputTarget = e.target;
        const file = inputTarget.files[0];

        if (file) {
            const reader = new FileReader();

            reader.addEventListener("load", function(e) {
                const readerTarget = e.target;

                const img = document.createElement("img");
                img.src = readerTarget.result;
                img.classList.add(my_class);
                img.id = my_class;

                pictureImage.innerHTML = "";
                pictureImage.appendChild(img);
            });

            reader.readAsDataURL(file);
        } else {
            pictureImage.innerHTML = pictureImageTxt;
        }
    });
}


function ImagePriviewUpdate(my_id,my_class,message,editValueImage) {
    const picture__input = document.querySelector("#"+my_id);
    const pictureImage = document.querySelector("."+my_class);
    var pictureImageTxt = '';

    if (editValueImage != null && editValueImage != '') {
        pictureImageTxt = '<img src="'+editValueImage+'" class="picture__img" id="picture__img">';
    } else {
        pictureImageTxt = message;
    }
    pictureImage.innerHTML = pictureImageTxt;

    picture__input.addEventListener("change", function(e) {
        const inputTarget = e.target;
        const file = inputTarget.files[0];

        if (file) {
            const reader = new FileReader();

            reader.addEventListener("load", function(e) {
                const readerTarget = e.target;

                const img = document.createElement("img");
                img.src = readerTarget.result;
                img.classList.add(my_class);
                img.id = my_class;

                pictureImage.innerHTML = "";
                pictureImage.appendChild(img);
            });

            reader.readAsDataURL(file);
        } else {
            pictureImage.innerHTML = pictureImageTxt;
        }
    });
}


function toBanglaNumber(input) {
    const engToBan = {
        '0': '০', '1': '১', '2': '২', '3': '৩', '4': '৪',
        '5': '৫', '6': '৬', '7': '৭', '8': '৮', '9': '৯'
    };
    return input.toString().split('').map(char => engToBan[char] || char).join('');
}
