//home
$(function() {
  $(document).on('refresh', '.page-home',function(e) {
    setTimeout(function() {
      $($("#index-tpl").html()).insertBefore($(".list a").eq(0));
      $.pullToRefreshDone('.page-home');
    }, 2000);
  });
  var loading = false;
  $(document).on('infinite', '.page-home',function() {
    if(loading) return;
    loading = true;
    setTimeout(function() {
      $("ul.collect_list").append($($("#index-tpl").html()));
      loading = false;
    }, 2000);
  });
});



$.init();
