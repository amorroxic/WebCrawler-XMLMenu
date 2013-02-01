(function() {
  var Logic;

  Logic = (function() {

    function Logic() {
      this.initApplication();
    }

    Logic.prototype.initApplication = function() {

      // no longer needed. menu managed via css

      // $(" .depth-1 ul ").css({display: "none"}); // Opera Fix
      // $(" .depth-1 li").hover(function() {
      //       $(this).find('ul:first').css({visibility: "visible",display: "none"}).show();
      //     }, function() {
      //       $(this).find('ul:first').css({visibility: "hidden"});
      //     });
      // }

    };

    return Logic;

  })();

  jQuery(document).ready(function() {
    return new Logic;
  });

}).call(this);
