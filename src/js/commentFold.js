
function findActiveIndex(children){
    var i = 0;
    while(i<children.length && children[i].getAttribute("class")!=="item active"){
	i++;
    }
    return i;
}
function next(){
    var node = document.getElementById("comments");
    var children = node.children;
    console.log(children[0]);
    console.log(children[1]);
    var index = findActiveIndex(children);	
        console.log(index);

    var newIndex = index === children.length -1? 0 :index+1;


    children[index].setAttribute("class","item");
    children[newIndex].setAttribute("class", "item active");
}

function previous(){
    var node = document.getElementById("comments");
    var children = node.children;
    var index = findActiveIndex(children);	

    var newIndex = index === 0? children.length -1 :index-1;

    children[index].setAttribute("class","item");
    children[newIndex].setAttribute("class", "item active");
}
