jQuery(document).ready(function($) {

	$('img.brand-image').load(function(){
		$('img.brand-image').each(function(){
			var height = $(this).height();
			console.log("height: " + height);
			var container_height = height + 120;
			console.log("container height: " + container_height);
			$(this).parents('.brand-container').css('height', container_height);
			var padding_height = ((262 - height) / 2) - 20;
			var padding_height_boat = ((container_height - height) / 2) - 20;
			var view_all_margin = padding_height / 4;
			var view_all_margin_boat = (((container_height + padding_height) - height) / 4);
			if( height >= 150 ){
				$(this).css('padding-top', padding_height_boat, 'padding-bottom', padding_height_boat);
			}
			else{
				$(this).css('padding-top', padding_height);
				$(this).parent().next('.view-all-boards').css('margin-top', view_all_margin);
			}
		});
	});

	$('.expand').on('click touch', function(){
		$('.review-content').slideToggle();
	})

	$('.menu-toggle').on('click touch', function(){
		$('.main-navigation ul, .search-box').slideToggle();
	})

	$('.fancybox').fancybox();

	$(window).load(function(){
		$('.board-container').isotope({
			layoutMode: 'masonry',
			itemSelector: '.brand-container',
			getSortData: {
				weight: '.weight-range',
				skill: '.skill-level',
				style: '.style'
			}
		});
		// $('.sort-buttons').on('click', 'div', function(){
		// 	var sortByValue = $(this).attr('data-sort-by');
		// 	$('.board-container').isotope({ sortBy: sortByValue });
		// });
		$('.filter-buttons').on('click', 'div', function(){
			var filterValue = $(this).attr('data-filter');
			$('.board-container').isotope({filter: filterValue });
		});

		var $container;
		var filters = {};

		$(function(){

		  $container = $('.board-container');

		  var $filterDisplay = $('#filter-display');

		  $container.isotope();
		  // do stuff when checkbox change
		  $('.sort-buttons').on( 'change', function( jQEvent ) {
		    var $checkbox = $( jQEvent.target );
		    manageCheckbox( $checkbox );

		    var comboFilter = getComboFilter( filters );

		    $container.isotope({ filter: comboFilter });

		    $filterDisplay.text( comboFilter );
		  });

		});

		function getComboFilter( filters ) {
		  var i = 0;
		  var comboFilters = [];
		  var message = [];

		  for ( var prop in filters ) {
		    message.push( filters[ prop ].join(' ') );
		    var filterGroup = filters[ prop ];
		    // skip to next filter group if it doesn't have any values
		    if ( !filterGroup.length ) {
		      continue;
		    }
		    if ( i === 0 ) {
		      // copy to new array
		      comboFilters = filterGroup.slice(0);
		    } else {
		      var filterSelectors = [];
		      // copy to fresh array
		      var groupCombo = comboFilters.slice(0); // [ A, B ]
		      // merge filter Groups
		      for (var k=0, len3 = filterGroup.length; k < len3; k++) {
		        for (var j=0, len2 = groupCombo.length; j < len2; j++) {
		          filterSelectors.push( groupCombo[j] + filterGroup[k] ); // [ 1, 2 ]
		        }

		      }
		      // apply filter selectors to combo filters for next group
		      comboFilters = filterSelectors;
		    }
		    i++;
		  }

		  var comboFilter = comboFilters.join(', ');
		  return comboFilter;
		}

		function manageCheckbox( $checkbox ) {
		  var checkbox = $checkbox[0];

		  var group = $checkbox.parents('.option-set').attr('data-group');
		  // create array for filter group, if not there yet
		  var filterGroup = filters[ group ];
		  if ( !filterGroup ) {
		    filterGroup = filters[ group ] = [];
		  }

		  // index of
		  var index = $.inArray( checkbox.value, filterGroup );

		  if ( checkbox.checked ) {
		    
		    if ( index === -1 ) {
		      // add filter to group
		      filters[ group ].push( checkbox.value );
		    }
		  } else {
		    // remove filter from group
		    filters[ group ].splice( index, 1 );
		  }

		}


	});

	$('.sort-by').on('click touch', function(){
		var option_set = $(this).next('.option-set')
		if(!option_set.hasClass('active')){
			$('.active').slideUp();
			$('.active').removeClass('active');
			option_set.slideDown();
			option_set.addClass('active');
		}
		else{
			option_set.slideUp();
			option_set.removeClass('active');
		}
	});

});


