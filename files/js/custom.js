(function($) {
    'use strict'; 
    new WOW().init();
        $('.tests').owlCarousel({
            loop:true, margin:10, nav:false, responsive:{
                0:{items:1},
                576:{items:1},
                768:{items:2},
                992:{items:3}
            }
        })
        $('.ecoms').owlCarousel({
            loop:true, margin:10, nav:false, responsive:{
                0:{items:3},
                576:{items:4},
                768:{items:5},
                992:{items:8}
            }
        })
})(jQuery);
$(document).ready(function(){$(".ecom").css({'display': 'block'});});
$(document).ready(function(){$("#main-section").css({'display': 'block'});});
function Searcher() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
            }
        }
    }
}
if (window.location.href === 'http://localhost/revgods/home') {$("nav a[href='./home']").addClass('active');}
if (window.location.href === 'http://localhost/revgods/addcourse') {$("nav a[href='./home']").addClass('active');}
if (window.location.href === 'http://localhost/revgods/questions') {$("nav a[href='./questions']").addClass('active');} 
if (window.location.href === 'http://localhost/revgods/addquestion') {$("nav a[href='./questions']").addClass('active');} 
if (window.location.href === 'http://localhost/revgods/results') {$("nav a[href='./results']").addClass('active');} 
if (window.location.href === 'http://localhost/revgods/revers') {$("nav a[href='./revers']").addClass('active');} 
if (window.location.href === 'http://localhost/revgods/addrever') {$("nav a[href='./revers']").addClass('active');} 
if (window.location.href === 'http://localhost/revgods/settings') {$("nav a[href='./settings']").addClass('active');} 