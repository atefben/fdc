$(".ba").length&&$(".nav li").click(function(){$(this).hasClass("active")||($(".nav").find(".active").removeClass("active"),$(this).addClass("active"),$(this).hasClass("infos-film-li")?($(".program-film").css({display:"none"}),$(".infos-film").css({display:"block"})):($(".program-film").css({display:"block"}),$(".infos-film").css({display:"none"})))});