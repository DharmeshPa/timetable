jQuery(document).ready(function($){
	var $container = $('body');
	var $content = $('.scroll');
	var $header = $('.header');
	var $subHeader = $('.sub-header');
	var $tableHeadings = $('.table-headings');

	// Calculate container and content heights
	var containerHeight = $container.height();
	var headerHeight = $header.outerHeight(true); // Include padding and margin
	var subHeaderHeight = $subHeader.outerHeight(true); // Include padding and margin
	var tableHeadingsHeight = $tableHeadings.outerHeight(true); // Include padding and margin
	var contentHeight = $content.outerHeight(true) + headerHeight + subHeaderHeight + tableHeadingsHeight;

	var scrollSpeed = 50; // Speed of the animation (lower is faster)
	var scrollStep = 1; // Pixel step per scroll
	var scrollDirection = 'down'; // Initial direction
	var delayTime = 5000; // 5 seconds delay in milliseconds

	// Only scroll if content height exceeds container height
	if (contentHeight > containerHeight) {
	    function scrollContent() {
	        var currentTop = $content.position().top;

	        if (scrollDirection === 'down') {
	            // Check if content has reached the bottom
	            if (Math.abs(currentTop) + containerHeight < contentHeight) {
	                // Continue scrolling down
	                $content.animate({ top: currentTop - scrollStep + "px" }, scrollSpeed, 'linear', scrollContent);
	            } else {
	                // Ensure it reaches the bottom completely
	                $content.animate({ top: -(contentHeight - containerHeight) + "px" }, scrollSpeed, 'linear', function() {
	                    // After reaching bottom, reverse direction and wait
	                    scrollDirection = 'up';
	                    setTimeout(scrollContent, delayTime);
	                });
	            }
	        } else if (scrollDirection === 'up') {
	            // Check if content has reached the top
	            if (currentTop < 0) {
	                // Continue scrolling up
	                $content.animate({ top: currentTop + scrollStep + "px" }, scrollSpeed, 'linear', scrollContent);
	            } else {
	                // Ensure it reaches the top completely
	                $content.animate({ top: "0px" }, scrollSpeed, 'linear', function() {
	                    // After reaching top, reverse direction and wait
	                    scrollDirection = 'down';
	                    setTimeout(scrollContent, delayTime);
	                });
	            }
	        }
	    }
	    // Initial 5-second delay before starting the scroll
	    setTimeout(scrollContent, delayTime);
	}
});