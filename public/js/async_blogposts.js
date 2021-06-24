function showContent(data) {
    // get the elements we need
    let template = document.getElementsByTagName("template")[0];
    let container = document.getElementById("content-container");
    let img = document.createElement("img");
    img.src = "https://picsum.photos/200/301";
    // fill the template
    template.content.querySelector("h1").innerHTML = data.title;
    template.content.querySelector("h4").innerHTML += data.author;
    template.content.querySelector("p").innerHTML = data.text;
    template.content.querySelector("img").innerHTML = img.src;


    // append a clone to the container
    let clone = template.content.cloneNode(true);
    container.appendChild(clone);
}

// get the blog posts URL key from the called URL
let urlKey = window.location.pathname;
urlKey = urlKey.split("/").pop();
urlKey = urlKey.split("?").shift();

fetch('/rest/blogposts/' + urlKey)
    .then(response => {

        if (!response.ok) {

            // TODO: proper error handling! An alert is the wort idea ever ^^
            alert('Could not load blog post with URL key "' + urlKey + '"');
        }
        return response.json();
    })
    .then(data => showContent(data));
