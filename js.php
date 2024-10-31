<script> 
    function pt_urlify( str ) {
        return str.replace(new RegExp(' ', 'g'), '_').toLowerCase();
    }

    function pt_list_callback( result ) {
        var list;
        var vote;
        switch(result.status) {
            case 'success':
                if (result.data.votes.length > 0) {
                    var listContainer = pt_get_list(result);
                    jQuery(listContainer).appendTo( jQuery('#pt_related') );
                    jQuery('#pt_related').fadeIn();
                } else {
                    jQuery('#pt_related').hide();
                }
            break;
            default:
            break;
        }
    }

    function pt_iframe_callback( result ) {
        var list;
        var vote;
        var aspectRatio = 0.6666;
        switch(result.status) {
            case 'success':
                if (result.data.votes.length > 0) {
                    var id = result.data.poet.id;
                    var iframe = pt_get_iframe(id, '<?php echo $method; ?>');
                    var noframes = jQuery('<noframes></noframes>');
                    var listContainer = pt_get_list(result);
                    noframes.append(listContainer);
                    jQuery(iframe).appendTo( jQuery('#pt_related') );
                    jQuery(noframes).appendTo( jQuery('#pt_related') );
                    jQuery('#pt_related').fadeIn();
                } else {
                    jQuery('#pt_related').hide();
                }
            break;
            default:
            break;
        }
        //once it has been added, set the aspect ratio on the iframe to remain constant on window resize
        $('iframe.pt_recs').attr('data-aspectRatio', aspectRatio).removeAttr('height').removeAttr('width');
        $(window).resize(function() {
            var newWidth = $('iframe.pt_recs').parent().width();
            $('iframe.pt_recs').width(newWidth).height(newWidth * $('iframe.pt_recs').attr('data-aspectRatio'));
        }).resize();
    }

    function pt_get_list(result) {
        listContainer = jQuery('<div></div>');
        list = jQuery('<ul class="pt_list"></ul>');
        for( i=0; i < result.data.votes.length && i < 3; i++ ) {
            vote = result.data.votes[i];
            list.append('<li class="pt_item">' +'<a href="https://poet.tips/poet/' + pt_urlify(vote.name) + '/" target="_blank">' + vote.name + '</a>' + '</li>');
        }
        listContainer.append(list);
        if (result.data.votes.length > 3) {
            listContainer.append('<a href="<?php echo $url; ?>" target="_blank">More&hellip;</a>');
        }
        return listContainer;
    }

    function pt_get_iframe(id, method) {
        iframe = jQuery('<iframe></iframe>');
        var url = 'https://poet.tips/graph/' + encodeURIComponent(method) + '?id=' + encodeURIComponent(id);
        iframe.attr('src', url);
        iframe.attr('border', 0);
        iframe.addClass('pt_recs');
        iframe.css('width','100%!important');
        iframe.css('height','auto!important');
        iframe.css('border', 0);
        return iframe;
    }
</script>
