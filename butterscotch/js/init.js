$(document).ready(function(){
	navColors();
});

function navColors(){
	var page = document.URL;
	var article = $("[id^=post]");
	var index = $("body.home");
	var searchPage = $('body.search');
	var body = $('body');
	
	if (index.length !== 0 || searchPage.length !== 0 )
	{
	}
	else if(page.indexOf("wine-sake") !== -1 || (article.hasClass("category-wine-sake") && body.hasClass("single"))  )
	{
		$('#nav-ws').addClass("wine-sake-selected");
	}
	else if (page.indexOf("spirits-cocktails") !== -1 || (article.hasClass("category-spirits-cocktails") && body.hasClass("single")) ) {
		$('#nav-sc').addClass("spirits-cocktails-selected");
	}
	else if (page.indexOf("food") !== -1 || (article.hasClass("category-food") && body.hasClass("single")) ) {
		$('#nav-f').addClass("food-selected");
	}
	else if (page.indexOf("news") !== -1 || (article.hasClass("category-news") && body.hasClass("single")) ) {
		$('#nav-n').addClass("news-selected");
	}		

}