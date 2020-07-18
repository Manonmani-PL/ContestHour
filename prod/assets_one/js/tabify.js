$().ready(
    function () {
		var activeTabAttibute = 'active-tab';
        var tabifierCss = ".tab-bar { margin-top: 1em; text-align: bottom; } .tab-bar > div { display: inline-block; ; border-bottom: none;   font-size: 13pt; background-color: #CECCC6; color: #000;  padding:5px 20px 5px 20px; margin-right: 5px;  position: relative; /*for fake z-indexing above the tab content*/ } .tab-bar > div["+activeTabAttibute+"] { background-color: #F94812; color: #fff; } .tab-bar > div:hover { background-color: #F94812; color: black; cursor: pointer; } [tabbed] { display: inline-block; list-style: none outside none;  width: 98%; min-height: 300px; padding-left: 1em; padding-right: 1em; padding-bottom: 1em; margin-top: 0; padding-top: 1em; }";
        $("<style type='text/css'>" + tabifierCss + "</style>").appendTo("head");

		$("[tabbed]").each(
			function(i, tabs){
				var tabBar = $("<div class='tab-bar' />");
				
				$(tabs).before(tabBar)
				.children().each(
					function (j, tabElement) {
						var tab = $(tabElement);
						
						var firstTabChild = tab.children()[0];
						var tabLabel = $("<div class='tab'>" + $(firstTabChild).html() + "</div>");
						$(firstTabChild).remove();
						
						if (j == 0) { //first tab is active on page load
							tabLabel.attr(activeTabAttibute, true);
						} else { 
							tab.hide(); 
						}
						tabLabel.click(
							function () {
								tabLabel.attr(activeTabAttibute, true)
									.siblings().removeAttr(activeTabAttibute);
								
								tab.show()
									.siblings().hide();
							}
						);
						tabBar.append(tabLabel);
					}
				);
			}
		);
    }
);