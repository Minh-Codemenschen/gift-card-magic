jQuery(document).ready(function ($) {

  $('#categorydiv').hide();
  $('#gift_card_categorydiv').show();
  $('#tagsdiv-post_tag').hide();

  // Function to get URL parameters
  function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
  }

  // Function to handle tab click event
  function handleTabClick(e) {
    e.preventDefault();
    var tab = $(this).data('tab');

    // Remove active class from all tabs and panels
    $('.nav-tab-wrapper .nav-tab').removeClass('nav-tab-active');
    $('.tab-panel').hide();

    // Add active class to the selected tab and show the corresponding panel
    $(this).addClass('nav-tab-active');
    $('#tab-' + tab).show();
  }

  // Add click event to tab elements
  $('.nav-tab-wrapper .nav-tab').on('click', handleTabClick);

  // Function to handle checkbox click event
  function handleCheckboxClick() {
    var name = '#' + $(this).attr('name');
    var associatedDiv = $(name);

    if (associatedDiv.length) {
      associatedDiv.toggle($(this).is(":checked"));
    }
  }

  // Add click event to toggle-slider-giftcardMagic elements
  $(".toogle-slider-giftcardMagic").click(handleCheckboxClick);

  // Get the current post type and taxonomy from the page URL
  var postType = getUrlParameter('post_type');
  var taxonomy = getUrlParameter('taxonomy');

  // Check if the current post type is 'gift_card_magic' or taxonomy is 'gift_card_category'
  if (postType === 'gift_card_magic' || taxonomy === 'gift_card_category') {
    // Add active class to the main menu of the plugin
    var giftCardMagicMenu = $("#toplevel_page_gift-card-magic");
    if (giftCardMagicMenu.length) {
      giftCardMagicMenu.removeClass("wp-not-current-submenu");
      giftCardMagicMenu.addClass("wp-has-current-submenu");
      giftCardMagicMenu.addClass("wp-menu-open");
      var giftCardMagicMenuLink = $("#toplevel_page_gift-card-magic a.menu-top");
      if (giftCardMagicMenuLink.length) {
        giftCardMagicMenuLink.removeClass("wp-not-current-submenu");
        giftCardMagicMenuLink.addClass("wp-has-current-submenu");
      }
    }

    // Remove active class from 'Posts' menu
    var postsMenu = $("#menu-posts");
    if (postsMenu.length) {
      postsMenu.removeClass("wp-has-current-submenu");
      postsMenu.removeClass("wp-menu-open");
      postsMenu.addClass("wp-not-current-submenu");
      var postsMenuLink = $("#menu-posts a.menu-top");
      if (postsMenuLink.length) {
        postsMenuLink.removeClass("wp-has-current-submenu");
        postsMenuLink.removeClass("wp-menu-open");
        postsMenuLink.addClass("wp-not-current-submenu");
      }
    }
  }
  $('#upload-logo').on('click', function (e) {
    e.preventDefault();
    var imageUploader = wp.media({
      title: 'Select Logo',
      button: {
        text: 'Set Logo Image'
      },
      multiple: false // Set to true for multiple image selection
    });

    imageUploader.on('select', function () {
      var attachment = imageUploader.state().get('selection').first().toJSON();
      $('#image_url').attr('src', attachment.url);
      $('#upload-logo').val(attachment.url);
      $('.preview-logo').addClass('show');
    });

    imageUploader.open();
  });
  $('#upload-bg-image').on('click', function (e) {
    e.preventDefault();
    var imageUploader = wp.media({
      title: 'Select Image',
      button: {
        text: 'Set Image'
      },
      multiple: false // Set to true for multiple image selection
    });

    imageUploader.on('select', function () {
      var attachment = imageUploader.state().get('selection').first().toJSON();
      $('#image_bg').attr('src', attachment.url);
      $('#upload-bg-image').val(attachment.url);
      $('.preview-logo').addClass('show');
    });
    imageUploader.open();
  });
  function toggleGroup(element, targetName) {
    if ($(element).is(':checked')) {
      $('.group-giftcardMagic [name="' + targetName + '"]').closest('.group-giftcardMagic').show();
    } else {
      $('.group-giftcardMagic [name="' + targetName + '"]').closest('.group-giftcardMagic').hide();
    }
  }

  $('.toogle-slider-giftcardMagic[name="show_name"]').on('change', function () {
    toggleGroup(this, 'your_name');
  });

  $('.toogle-slider-giftcardMagic[name="show_recipient_name"]').on('change', function () {
    toggleGroup(this, 'from_name');
  });

  $('.toogle-slider-giftcardMagic[name="show_voucher_value"]').on('change', function () {
    toggleGroup(this, 'voucher_value');
  });
  $('.toggle-giftcardMagic input[data-id]').click(function(){
    var data_id = $(this).attr('data-id');
    $('#'+data_id).toggleClass('hide');
  });
  $('.toogle-slider-giftcardMagic').click(function(){
    if($(this).is(':checked')) {
      $(this).closest('.group-setting-giftcardMagic').find('.toogle-value-giftcardMagic').val(1);
    } else {
      $(this).closest('.group-setting-giftcardMagic').find('.toogle-value-giftcardMagic').val(0);
    }
  });
  $('input[name="gcm_settings_frontend[background_color]"]').change(function(){
    $('.wrap-item-giftcardMagic').css('background-color',$(this).val());
  })
  $('input[name="gcm_settings_frontend[text_color]"]').change(function(){
    $(this).closest('.box-giftcardMagic').find('.group-giftcardMagic').css('color',$(this).val());
  });
  var editorSettings = {
    // Settings for the first editor
    textarea_name: 'gcm_email[buyer_email_subject]',

    // Customize other settings as needed

  };
  tinymce.init(editorSettings);

  var editorSettings2 = {
      // Settings for the second editor
      textarea_name: 'gcm_email[buyer_email_body]',

      // Customize other settings as needed

  };
  tinymce.init(editorSettings2);
});
