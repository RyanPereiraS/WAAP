let time = 2000,
    currentImageIndex = 0,
    
    image = document
                .querySelectorAll("#slider img")
    max = image.length;


    function nextImage(){

        image[currentImageIndex]
            .classList.remove("selected")
       
        currentImageIndex++

        if (currentImageIndex >= max) {
            currentImageIndex = 0
        }

       image[currentImageIndex]
            .classList.add("selected")
    }


function start() {
   setInterval(() => {
    nextImage()
   }, time)
}

window.addEventListener('load', start)


