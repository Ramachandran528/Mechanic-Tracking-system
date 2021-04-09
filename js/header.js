window.addEventListener("scroll",function()
{
    const header=document.querySelector("header");
    if(scrollY>0)
    {
        header.style.backgroundColor="#fbfbff";
        header.style.padding="10px";
        header.style.boxShadow="5px 2px 10px rgba(0, 0, 0, 0.3)";
    }
    else 
    {
        header.style.backgroundColor="#f0f3ff";
        header.style.padding="15px 10px 15px 10px";
        header.style.boxShadow="0px 0px 0px rgba(0, 0, 0, 0.3)";
    }
})

const menus=document.querySelectorAll(".menu");
menus.forEach(menu => {
    menu.addEventListener("click",function()
    {
        for(var i=0;i<menus.length;i++)
        menus[i].classList.remove("active");
        menu.classList.add("active");
    });
});
console.log(menus)