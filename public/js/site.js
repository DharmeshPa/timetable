/**
 * Content Management System
 * This script manages the display and timing of content elements on a page
 * including slides, messages, and topics based on scheduled time slots.
 */
jQuery(document).ready(function($){

    // Cache DOM elements for better performance
    const contents = $('.content-details');          // All content elements
    const contentsHidden = $('.content-details.hidden'); // Hidden content elements
    const topics = $(".topics");                    // Topic elements container
    const header = $(".header div").eq(1);          // Header element for time display
    const screenHeight = $(window).height();// Height of the current window
    const noTimetable = $("#no-timetable").length
    /**
     * Configuration object for different date-time formats used throughout the application
    */
    const dateFormats = {
        full: 'YYYY-MM-DD HH:mm:ss',      // Complete date-time format
        dateHrsMin: 'YYYY-MM-DD HH:mm',    // Date with hours and minutes
        hrsMinSec: 'HH:mm:ss',            // Time with seconds
        hrsMin: 'HH:mm',                  // Time without seconds
    };

    /**
     * Formats a date-time string according to specified format
     * @param {string} dateTime - The date-time to format
     * @param {string} format - The desired format from dateFormats object
     * @returns {string} Formatted date-time string
    */
    function getTime(dateTime, format) {
        return moment(dateTime).format(format);
    }

    /**
     * Sets the height of slider elements and their containers
     * @param {jQuery} element - The slider container element
     * @param {string|number} height - The height to set
     */
    function sliderHeight(element, height) {
        const selectors = [
            '.bx-wrapper',
            '.bx-wrapper .bx-viewport',
            '.bx-wrapper .bx-viewport .bxslider'
        ];
        selectors.forEach(selector => {
            $element.find(selector).css('height', height);
        });
    }

    //reload the page
    function reload(){
    	//do we have internet connection
    	//location.reload();
   	}
    /**
     * Retrieves the content type from an element's data attribute
     * @param {jQuery} element - The element to check
     * @returns {string} The content type
     */
    function contentType(element) {
        return element.data('content-type');
    }

    /**
     * Manages the active/inactive states of content elements and updates their display
     * @param {jQuery} $element - The element to update
     * @param {boolean} isActive - Whether the element should be active
     */
    function updateElementState($element, isActive) {
        const classes = 'fixed top-0 left-0 right-0 w-100 z-[99]';
        const contentTypes = ['graphic', 'message', 'video'];

        const activeElement = $(".active").eq(0);
        const activeElementNext = activeElement.next();
        
        const inArrayActive = $.inArray(contentType(activeElement), contentTypes) !== -1;
        const inArrayOther = $.inArray(contentType($element), contentTypes) !== -1;

        // Handle active content with valid content type
        if(isActive && inArrayActive) {
            activeElement.find('ul').removeClass('hidden');
            activeElement.addClass(classes);
            // Handle second slider if present
            activeElementNext.find('ul').removeClass('hidden');
            activeElementNext.addClass(classes);
            sliderHeight(activeElement, screenHeight);
            sliderHeight(activeElementNext, screenHeight);
            topics.addClass('hidden');
        } 
        // Handle active content with invalid content type
        else if(isActive && !inArrayActive) {
            $element.removeClass(classes);
            topics.removeClass('hidden');
        }
        // Handle inactive content with valid content type
        else if(!isActive && inArrayOther) {
            $element.find('ul').addClass('hidden');
            $element.removeClass(classes);
            sliderHeight(activeElement, '0px');
            sliderHeight(activeElementNext, '0px');
            activeElementNext.find('ul').addClass('hidden');
            activeElementNext.removeClass(classes);
            topics.removeClass('hidden');
        }
    }

    /**
     * Main update loop that runs every second
     * Updates system time, checks content timing, and manages content visibility
     */
    setInterval(function() {
        // Update system time
        systemTime = moment(systemTime).add(1, 'seconds').format(dateFormats.full);
        const now = moment().add(offset,'hours').format(dateFormats.full);

        //if the date has been changes then refresh the page
        if(now > systemTime){
		    reload();
		}

		//if not timetable all
		if(noTimetable){
			reload();
		}
		// Update displayed time
        $(header).html(getTime(systemTime, dateFormats.hrsMin));

        // Process each content element
        $.each(contents, function(index, element) {
            $element = $(this);

            // Extract timing data from element attributes
            const timetableId = $element.data('timetable-id');
            const timetableStartTime = $element.data('timetable-start-time');
            const timetableEndTime = $element.data('timetable-end-time');
            const contentStartTime = $element.data('content-start-time');
            const contentEndTime = $element.data('content-end-time');
            const contentType = $element.data('content-type');
            const contentExpireTime = $element.data('content-expire-time');

            // Check if timetable has ended
            if(getTime(timetableEndTime, dateFormats.full) < getTime(systemTime, dateFormats.full)) {
                reload();
            }
            // Check if content should be active
            const isActive = getTime(contentStartTime, dateFormats.hrsMin) <= getTime(systemTime, dateFormats.hrsMin) && 
                           getTime(systemTime, dateFormats.hrsMin) <= getTime(contentEndTime, dateFormats.hrsMin);

            // Update element active state
            (isActive ? $element.addClass('active') : $element.removeClass('active'));
            
            updateElementState($element, isActive);
            
            // Check for expired content
            if(getTime(systemTime, dateFormats.dateHrsMin) > getTime(contentExpireTime, dateFormats.dateHrsMin)) {
                reload();
            }
        });
    }, 1000); // Update every second
});