
let change = function(parent, image) {
    let current = parent.querySelector(".current")

    if (current) {
        current.classList.remove("current")
    }

    image.classList.add("current")
}

let galleries = document.querySelectorAll(".bkr-gallery-block")

for (let i = 0; i < galleries.length; i ++) {
    let prev = galleries[i].querySelector(".bkr-gallery-block-prev")
    let next = galleries[i].querySelector(".bkr-gallery-block-next")
    let images = galleries[i].querySelectorAll("img")
    galleries[i].dataset.index = 0

    prev.addEventListener("click", function () {
        if (galleries[i].dataset.index > 0) {
            galleries[i].dataset.index--
            let image = images[galleries[i].dataset.index]
            change(galleries[i], image)
        }
    });

    next.addEventListener("click", function () {
        if (galleries[i].dataset.index < (images.length - 1)) {
            galleries[i].dataset.index++
            let image = images[galleries[i].dataset.index]
            change(galleries[i], image)
        }
    });
}