$(document).ready(function() {
var bt = $("#bt"),
	cat = $("#cat"),
	ct = $("#ct");
window.bo = $("#bout");
ct.hide();
bt.hide();
ospd = {
	duration: 1200,
	queue: false,
	easing: "easeOutCubic"
};
cspd = {
	duration: 600,
	queue: false,
	easing: "easeInCubic"
};
bo.mouseenter(function() {
	bt.slideDown(ospd);
});
bo.mouseleave(function() {
	bt.slideUp(cspd);
});
cat.mouseenter(function() {
	ct.slideDown(ospd);
});
cat.mouseleave(function() {
	ct.slideUp(cspd);
});
});