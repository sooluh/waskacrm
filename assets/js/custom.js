function run(App, $) {
  App.Package.name = 'WaskaCRM';
  App.Package.version = '0.0.1';

  var $win = $(window);
  var $body = $('body');
  var $doc = $(document);
  var _menu = 'waska-menu';
  var _header_menu = 'waska-header-menu';
  var _sidebar = 'waska-sidebar';
  var _sidebar_mob = 'waska-sidebar-mobile';
  var _break = App.Break;

  function extend(object, ext) {
    Object.assign(object, ext);
    return object;
  }

  App.ClassBody = function () {
    App.AddInBody(_sidebar);
  };

  App.ClassNavMenu = function () {
    App.BreakClass('.' + _header_menu, _break.lg, {
      timeOut: 0,
    });

    App.BreakClass('.' + _sidebar, _break.lg, {
      timeOut: 0,
      classAdd: _sidebar_mob,
    });

    $win.on('resize', function () {
      App.BreakClass('.' + _header_menu, _break.lg);
      App.BreakClass('.' + _sidebar, _break.lg, {
        classAdd: _sidebar_mob,
      });
    });
  };

  App.CurrentLink = function () {
    var _link = '.waska-menu-link, .menu-link, .nav-link';
    var _currentUrl = window.location.href;
    var fileName = _currentUrl.substring(0, _currentUrl.indexOf('#') == -1 ? _currentUrl.length : _currentUrl.indexOf('#'));
    fileName = fileName.substring(0, fileName.indexOf('?') == -1 ? fileName.length : fileName.indexOf('?'));

    $(_link).each(function () {
      var self = $(this);
      var _self_link = self.attr('href');

      if (fileName.match(_self_link)) {
        self.closest('li').addClass('active current-page').parents().closest('li').addClass('active current-page');
        self.closest('li').children('.waska-menu-sub').css('display', 'block');
        self.parents().closest('li').children('.waska-menu-sub').css('display', 'block');
      } else {
        self.closest('li').removeClass('active current-page').parents().closest('li:not(.current-page)').removeClass('active');
      }
    });
  };

  App.PassSwitch = function () {
    App.Passcode('.passcode-switch');
  };

  App.Toast = function (message, type, options) {
    type = type ? type : 'info';
    var msi = '';
    var icon = type === 'info' ? 'ni ni-info-fill' :
      type === 'success' ? 'ni ni-check-circle-fill' :
        type === 'error' ? 'ni ni-cross-circle-fill' :
          type === 'warning' ? 'ni ni-alert-fill' : '';
    var def = {
      position: 'bottom-right',
      ui: '',
      icon: 'auto',
      clear: false
    };
    var attr = options ? extend(def, options) : def;

    attr.position = attr.position ? 'toast-' + attr.position : 'toast-bottom-right';
    attr.icon = attr.icon === 'auto' ? icon : attr.icon ? attr.icon : '';
    attr.ui = attr.ui ? ' ' + attr.ui : '';

    msi = attr.icon !== '' ? '<span class="toastr-icon"><em class="icon ' + attr.icon + '"></em></span>' : '';
    message = message !== '' ? msi + '<div class="toastr-text">' + message + '</div>' : '';

    if (message !== "") {
      if (attr.clear === true) {
        toastr.clear();
      }

      var defaultOptions = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": attr.position + attr.ui,
        "closeHtml": '<span class="btn-trigger">Close</span>',
        "preventDuplicates": true,
        "showDuration": "1500",
        "hideDuration": "1500",
        "timeOut": "2000",
        "toastClass": "toastr",
        "extendedTimeOut": "3000"
      };
      toastr.options = extend(defaultOptions, attr);
      toastr[type](message);
    }
  };

  function toHtml(json) {
    function render(object) {
      var attr = Object.keys(object.attr || {}).map(function (key) {
        return ' ' + key + '="' + object.attr[key] + '"';
      }).join('');

      var close = [
        'area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta', 'param',
        'source', 'track', 'wbr', 'command', 'keygen', 'menuitem',
      ].includes(object.name);

      return {
        start: '<' + object.name + attr + (close ? '/' : '') + '>',
        end: close ? ':' : '</' + object.name + '>',
      };
    }

    var html = '';
    var is = {
      array: json instanceof Array,
      string: typeof json.content === 'string',
    };

    var iterator = (is.array ? json : is.string ? false : json.content) || [];
    if (!is.array && is.string) html += json.content;

    for (var i = 0; i < iterator.length; i++) {
      html += toHtml(iterator[i]);
    }

    var result = render(json);
    return is.array ? html : result.start + html + result.end;
  }

  function isHtml(string) {
    var document = new DOMParser().parseFromString(string, 'text/html');
    return Array.from(document.body.childNodes).some(function (node) {
      return node.nodeType === 1;
    });
  }

  App.TGL.screen = function (element) {
    if ($(element).exists()) {
      $(element).each(function () {
        var size = $(this).data('toggle-screen');
        if (size) {
          $(this).addClass('toggle-screen-' + size);
        }
      });
    }
  };

  App.TGL.content = function (elm, opt) {
    var toggle = elm ? elm : '.toggle';
    var $toggle = $(toggle);
    var $data = $('[data-content]');
    var toggleBreak = true;
    var toggleCurrent = false;
    var def = {
      active: 'active',
      content: 'content-active',
      "break": toggleBreak
    };
    var attr = opt ? extend(def, opt) : def;

    App.TGL.screen($data);

    $toggle.on('click', function (evt) {
      toggleCurrent = this;
      App.Toggle.trigger($(this).data('target'), attr);

      evt.preventDefault();
    });

    $doc.on('mouseup', function (evt) {
      if (toggleCurrent) {
        var $toggleCurrent = $(toggleCurrent);
        var currentTarget = $(toggleCurrent).data('target');
        var $contentCurrent = $("[data-content=\"".concat(currentTarget, "\"]"));
        var $s2c = $('.select2-container');
        var $dpd = $('.datepicker-dropdown');
        var $tpc = $('.ui-timepicker-container');
        var $mdl = $('.modal');

        if (
          !$toggleCurrent.is(evt.target) &&
          $toggleCurrent.has(evt.target).length === 0 &&
          !$contentCurrent.is(evt.target) &&
          $contentCurrent.has(evt.target).length === 0 &&
          !$s2c.is(evt.target) &&
          $s2c.has(evt.target).length === 0 &&
          !$dpd.is(evt.target) &&
          $dpd.has(evt.target).length === 0 &&
          !$tpc.is(evt.target) &&
          $tpc.has(evt.target).length === 0 &&
          !$mdl.is(evt.target) &&
          $mdl.has(evt.target).length === 0
        ) {
          App.Toggle.removed($toggleCurrent.data('target'), attr);
          toggleCurrent = false;
        }
      }
    });

    $win.on('resize', function () {
      $data.each(function () {
        var content = $(this).data('content');
        var size = $(this).data('toggle-screen');
        var toggleBreak = _break[size];

        if (App.Win.width > toggleBreak) {
          App.Toggle.removed(content, attr);
        }
      });
    });
  };

  App.TGL.expand = function (elm, opt) {
    var toggle = elm ? elm : '.expand';
    var def = { toggle: true };
    var attr = opt ? extend(def, opt) : def;

    $(toggle).on('click', function (evt) {
      App.Toggle.trigger($(this).data('target'), attr);
      evt.preventDefault();
    });
  };

  App.TGL.ddmenu = function (elm, opt) {
    var imenu = elm ? elm : '.waska-menu-toggle';
    var def = {
      active: 'active',
      self: 'waska-menu-toggle',
      child: 'waska-menu-sub',
    };
    var attr = opt ? extend(def, opt) : def;

    $(imenu).on('click', function (evt) {
      if (App.Win.width < _break.lg || $(this).parents().hasClass(_sidebar)) {
        App.Toggle.dropMenu($(this), attr);
      }

      evt.preventDefault();
    });
  };

  App.TGL.showmenu = function (elm, opt) {
    var toggle = elm ? elm : '.waska-nav-toggle';
    var $toggle = $(toggle);
    var $contentD = $('[data-content]');
    var toggleBreak = $contentD.hasClass(_header_menu) ? _break.lg : _break.xl;
    var toggleOlay = _sidebar + '-overlay';
    var toggleClose = {
      profile: true,
      menu: false,
    };
    var def = {
      active: 'toggle-active',
      content: _sidebar + '-active',
      body: 'nav-shown',
      overlay: toggleOlay,
      "break": toggleBreak,
      close: toggleClose
    };
    var attr = opt ? extend(def, opt) : def;

    $toggle.on('click', function (evt) {
      App.Toggle.trigger($(this).data('target'), attr);
      evt.preventDefault();
    });

    $doc.on('mouseup', function (evt) {
      if (
        !$toggle.is(evt.target) &&
        $toggle.has(evt.target).length === 0 &&
        !$contentD.is(evt.target) &&
        $contentD.has(evt.target).length === 0 &&
        App.Win.width < toggleBreak
      ) {
        App.Toggle.removed($toggle.data('target'), attr);
      }
    });

    $win.on('resize', function () {
      if ((App.Win.width < _break.xl || App.Win.width < toggleBreak) && !App.State.isMobile) {
        App.Toggle.removed($toggle.data('target'), attr);
      }
    });
  };

  App.sbCompact = function () {
    var toggle = '.waska-nav-compact';
    var $toggle = $(toggle);
    var $sidebar = $('.' + _sidebar);
    var $sidebar_body = $('.' + _sidebar + '-body');

    $toggle.on('click', function (evt) {
      evt.preventDefault();
      var $self = $(this);
      var get_target = $self.data('target');
      var $self_content = $('[data-content=' + get_target + ']');

      $self.toggleClass('compact-active');
      $self_content.toggleClass('is-compact');

      if (!$self_content.hasClass('is-compact')) {
        $self_content.removeClass('has-hover');
      }
    });

    $sidebar_body.on('mouseenter', function (_evt) {
      if ($sidebar.hasClass('is-compact')) {
        $sidebar.addClass('has-hover');
      }
    });

    $sidebar_body.on('mouseleave', function (_evt) {
      if ($sidebar.hasClass('is-compact')) {
        $sidebar.removeClass('has-hover');
      }
    });
  };

  App.Ani.formSearch = function (elm, opt) {
    var def = {
      active: 'active',
      timeout: 400,
      target: '[data-search]'
    };
    var attr = opt ? extend(def, opt) : def;
    var $elem = $(elm);
    var $target = $(attr.target);

    if ($elem.exists()) {
      $elem.on('click', function (evt) {
        evt.preventDefault();

        var $self = $(this);
        var the_target = $self.data('target');
        var $self_st = $('[data-search=' + the_target + ']');
        var $self_tg = $('[data-target=' + the_target + ']');

        if (!$self_st.hasClass(attr.active)) {
          $self_tg.add($self_st).addClass(attr.active);
          $self_st.find('input').focus();
        } else {
          $self_tg.add($self_st).removeClass(attr.active);
          setTimeout(function () {
            $self_st.find('input').val('');
          }, attr.timeout);
        }
      });

      $doc.on({
        keyup: function keyup(evt) {
          if (evt.key === "Escape") {
            $elem.add($target).removeClass(attr.active);
          }
        },
        mouseup: function mouseup(evt) {
          if (!$target.find('input').val() && !$target.is(evt.target) && $target.has(evt.target).length === 0 && !$elem.is(evt.target) && $elem.has(evt.target).length === 0) {
            $elem.add($target).removeClass(attr.active);
          }
        }
      });
    }
  };

  App.Ani.formElm = function (elm, opt) {
    var def = {
      focus: 'focused'
    };
    var attr = opt ? extend(def, opt) : def;

    if ($(elm).exists()) {
      $(elm).each(function () {
        var $self = $(this);

        if ($self.val()) {
          $self.parent().addClass(attr.focus);
        }

        $self.on({
          focus: function focus() {
            $self.parent().addClass(attr.focus);
          },
          blur: function blur() {
            if (!$self.val()) {
              $self.parent().removeClass(attr.focus);
            }
          }
        });
      });
    }
  };

  App.Validate = function (elm, opt) {
    if ($(elm).exists()) {
      $(elm).each(function () {
        var def = {
          errorElement: "span"
        };
        var attr = opt ? extend(def, opt) : def;

        $(this).validate(attr);

        App.Validate.OnChange('.js-select2');
        App.Validate.OnChange('.date-picker');
        App.Validate.OnChange('.js-tagify');
      });
    }
  };

  App.Validate.OnChange = function (elm) {
    $(elm).on('change', function () {
      $(this).valid();
    });
  };

  App.Validate.init = function () {
    App.Validate('.form-validate', {
      errorElement: "span",
      errorClass: "invalid",
      errorPlacement: function errorPlacement(error, element) {
        if (element.parents().hasClass('input-group')) {
          error.appendTo(element.parent().parent());
        } else {
          error.appendTo(element.parent());
        }
      }
    });
  };

  App.Dropzone = function (elm, opt) {
    if ($(elm).exists()) {
      $(elm).each(function () {
        var maxFiles = $(elm).data('max-files');
        maxFiles = maxFiles ? maxFiles : null;
        var maxFileSize = $(elm).data('max-file-size');
        maxFileSize = maxFileSize ? maxFileSize : 256;
        var acceptedFiles = $(elm).data('accepted-files');
        acceptedFiles = acceptedFiles ? acceptedFiles : null;
        var def = {
          autoDiscover: false,
          maxFiles: maxFiles,
          maxFilesize: maxFileSize,
          acceptedFiles: acceptedFiles
        };
        var attr = opt ? extend(def, opt) : def;

        $(this).addClass('dropzone').dropzone(attr);
      });
    }
  };

  App.Dropzone.init = function () {
    App.Dropzone('.upload-zone', {
      url: "/images"
    });
  };

  App.Wizard = function () {
    var $wizard = $(".waska-wizard");

    if ($wizard.exists()) {
      $wizard.each(function () {
        var $self = $(this);
        var _self_id = $self.attr('id');
        var $self_id = $('#' + _self_id).show();

        $self_id.steps({
          headerTag: ".waska-wizard-head",
          bodyTag: ".waska-wizard-content",
          labels: {
            finish: "Submit",
            next: "Next",
            previous: "Prev",
            loading: "Loading ..."
          },
          titleTemplate: '<span class="number">0#index#</span> #title#',
          onStepChanging: function onStepChanging(_evt, currentIndex, newIndex) {
            if (currentIndex > newIndex) {
              return true;
            }

            if (currentIndex < newIndex) {
              $self_id.find(".body:eq(" + newIndex + ") label.error").remove();
              $self_id.find(".body:eq(" + newIndex + ") .error").removeClass("error");
            }

            $self_id.validate().settings.ignore = ":disabled,:hidden";
            return $self_id.valid();
          },
          onFinishing: function onFinishing(_evt, _current) {
            $self_id.validate().settings.ignore = ":disabled";
            return $self_id.valid();
          },
          onFinished: function onFinished(_evt, _current) {
            window.location.href = "#";
          }
        }).validate({
          errorElement: "span",
          errorClass: "invalid",
          errorPlacement: function errorPlacement(error, element) {
            error.appendTo(element.parent());
          }
        });
      });
    }
  };

  function actionButton(childrens) {
    return {
      name: 'ul', attr: { class: 'waska-tb-actions gx-1' },
      content: [
        {
          name: 'li', content: [
            {
              name: 'div', attr: { class: 'dropdown' }, content: [
                {
                  name: 'a', attr: {
                    'class': 'dropdown-toggle btn btn-icon btn-trigger',
                    'data-bs-toggle': 'dropdown',
                  },
                  content: [
                    { name: 'em', attr: { class: 'icon ni ni-more-h' } },
                  ],
                },
                {
                  name: 'div', attr: { class: 'dropdown-menu dropdown-menu-end' }, content: [
                    {
                      name: 'ul', attr: { class: 'link-list-opt no-bdr' }, content: childrens,
                    },
                  ],
                },
              ],
            },
          ],
        },
      ],
    };
  }

  App.DataTable = function (elm, opt) {
    if ($(elm).exists()) {
      var columns = window.constants.columns || [];

      $(elm).each(function () {
        var serverSide = $(this).data('serverside');
        var autoResponsive = $(this).data('auto-responsive');
        var action = document.querySelector('[data-column="action"]');
        var hasExport = typeof opt.buttons !== 'undefined' && opt.buttons ? true : false;
        var exportTitle = $(this).data('export-title') ? $(this).data('export-title') : 'Ekspor';

        if (action) {
          columns.push({
            data: 'action',
            orderable: false,
            searchable: false,
            render: function (_data, _type, row) {
              var features = action.getAttribute('data-features') || '';
              var actions = [];

              if (features.includes('detail-page')) {
                actions.push({
                  name: 'a',
                  attr: { href: window.location.href + '/detail/' + row.id },
                  content: [
                    { name: 'em', attr: { class: 'icon ni ni-eye' } },
                    { name: 'span', content: 'Detail' },
                  ],
                });
              }

              if (features.includes('edit-page')) {
                actions.push({
                  name: 'a',
                  attr: { href: window.location.href + '/edit/' + row.id },
                  content: [
                    { name: 'em', attr: { class: 'icon ni ni-pen' } },
                    { name: 'span', content: 'Ubah' },
                  ],
                });
              } else if (features.includes('edit')) {
                var edit = {
                  'data-bs-toggle': 'modal',
                  'data-bs-target': "#form-modal",
                };

                for (var key in row) {
                  if (!['num'].includes(key) && !isHtml(row[key])) {
                    edit['data-' + key] = String(row[key]);
                  }
                }

                actions.push({
                  name: 'a',
                  attr: extend({ href: 'javascript:void(0)', class: 'edit-button' }, edit),
                  content: [
                    { name: 'em', attr: { class: 'icon ni ni-pen' } },
                    { name: 'span', content: 'Ubah' },
                  ],
                });
              }

              if (features.includes('delete')) {
                actions.push({
                  name: 'a',
                  attr: {
                    'href': 'javascript:void(0)',
                    'data-id': row.id || 0,
                    'data-name': row.name || '',
                    'data-action': 'delete',
                  },
                  content: [
                    { name: 'i', attr: { class: 'icon ni ni-trash' } },
                    { name: 'span', content: 'Hapus' },
                  ],
                });
              }

              return toHtml(actionButton(actions.map(function (href) {
                return { name: 'li', content: [href] };
              })));
            }
          });
        }

        var button = hasExport ? '<"dt-export-buttons d-flex align-center' +
          '"<"dt-export-title d-none d-md-inline-block">B>' : '';
        var withExport = hasExport ? ' with-export' : '';

        var normalDom =
          '<"row justify-between g-2' +
          withExport +
          '"<"col-7 col-sm-4 text-start"f><"col-5 col-sm-8 text-end"<"datatable-filter' +
          '"<"d-flex justify-content-end g-2"' +
          button +
          'l>>>><"datatable-wrap my-3"t><"row align-items-center' +
          '"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-start text-md-end"i>>';

        var separateDom =
          '<"row justify-between g-2' +
          withExport +
          '"<"col-7 col-sm-4 text-start"f><"col-5 col-sm-8 text-end"<"datatable-filter' +
          '"<"d-flex justify-content-end g-2"' +
          button +
          'l>>>><"my-3"t><"row align-items-center' +
          '"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-start text-md-end"i>>';

        var def = {
          retrieve: true,
          fixedHeader: true,
          responsive: true,
          autoWidth: false,
          dom: $(this).hasClass('is-separate') ? separateDom : normalDom,
          lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, 'Semua'],
          ],
          language: {
            emptyTable: 'Tidak ada data yang tersedia pada tabel ini.',
            processing: 'Sedang memproses ...',
            search: '',
            searchPlaceholder: 'Ketik untuk mencari',
            lengthMenu:
              '<span class="d-none d-sm-inline-block">Lihat</span>' +
              '<div class="form-control-select"> _MENU_ </div>',
            zeroRecords: 'Tidak ditemukan data yang sesuai',
            info: '_START_ -_END_ dari _TOTAL_',
            infoEmpty: '',
            infoFiltered: '(total _MAX_ )',
            paginate: {
              first: '<em class="icon ni ni-chevrons-left"></em>',
              previous: '<em class="icon ni ni-chevron-left"></em>',
              next: '<em class="icon ni ni-chevron-right"></em>',
              last: '<em class="icon ni ni-chevrons-right"></em>',
            },
          },
          createdRow: function (row, data, _index) {
            $(row).addClass('waska-tb-item');
            var length = $('td', row).length;

            $.each($('td', row), function (index) {
              var column = window.constants.columns[index];
              if (!('data' in column) || !column.data) {
                return;
              }

              $(this).attr('data-column', column.data);
              $(this).addClass('waska-tb-col ' + ('rowClass' in column ? column.rowClass : ''));

              if (column.rowTemplate) {
                var value = data[column.data];

                if (new Date(value) !== 'Invalid Date') {
                  value.__proto__.date = function () {
                    return value.split(' ').slice(0, -1).join(' ');
                  };
                }

                $(this).html(eval('`' + column.rowTemplate + '`'));
              }

              if (index + 1 === length) {
                $(this).attr('data-column', 'actions');
                $(this).addClass('waska-tb-col-tools');
              }
            });
          },
        };

        var ajax = {
          processing: true,
          serverSide: true,
          ajax: {
            url: serverSide,
            type: 'POST',
          },
          order: [],
          columns: columns,
        };

        var attr = opt ? extend(def, opt) : def;
        attr = autoResponsive === false ? extend(attr, { responsive: false }) : attr;
        attr = serverSide ? extend(attr, ajax) : attr;

        $(this).DataTable(attr);
        $('.dt-export-title').text(exportTitle);
      });
    }
  };

  App.DataTable.init = function () {
    App.DataTable('.datatable-init', {
      responsive: {
        details: true
      }
    });

    App.DataTable('.datatable-init-export', {
      responsive: {
        details: true
      },
      buttons: ['copy', 'excel', 'csv', 'pdf', 'colvis']
    });

    $.fn.DataTable.ext.pager.numbers_length = 7;
  };

  App.BS.ddfix = function (elm, exc) {
    var dd = elm ? elm : '.dropdown-menu';
    var ex = exc ? exc :
      'a:not(.clickable), button:not(.clickable), ' +
      'a:not(.clickable) *, button:not(.clickable) *';

    $(dd).on('click', function (evt) {
      if (!$(evt.target).is(ex)) {
        evt.stopPropagation();
        return;
      }
    });

    if (App.State.isRTL) {
      var $dMenu = $('.dropdown-menu');

      $dMenu.each(function () {
        var $self = $(this);

        if ($self.hasClass('dropdown-menu-right') && !$self.hasClass('dropdown-menu-center')) {
          $self.prev('[data-toggle="dropdown"]').dropdown({
            popperConfig: {
              placement: 'bottom-start'
            }
          });
        } else if (!$self.hasClass('dropdown-menu-right') && !$self.hasClass('dropdown-menu-center')) {
          $self.prev('[data-toggle="dropdown"]').dropdown({
            popperConfig: {
              placement: 'bottom-end'
            }
          });
        }
      });
    }
  };

  App.BS.tabfix = function (elm) {
    var tab = elm ? elm : '[data-toggle="modal"]';
    $(tab).on('click', function () {
      var _this = $(this);
      var target = _this.data('target');
      var target_href = _this.attr('href');
      var tg_tab = _this.data('tab-target');

      var modal = target ? $body.find(target) : $body.find(target_href);

      if (tg_tab && tg_tab !== '#' && modal) {
        modal.find('[href="' + tg_tab + '"]').tab('show');
      } else if (modal) {
        var tabdef = modal.find('.waska-nav.nav-tabs');
        var link = $(tabdef[0]).find('[data-toggle="tab"]');
        $(link[0]).tab('show');
      }
    });
  };

  App.ModeSwitch = function () {
    var toggle = $('.dark-switch');

    if ($body.hasClass('dark-mode')) {
      toggle.addClass('active');
    } else {
      toggle.removeClass('active');
    }

    toggle.on('click', function (evt) {
      evt.preventDefault();
      $(this).toggleClass('active');
      $body.toggleClass('dark-mode');
    });
  };

  App.Knob = function (elm, opt) {
    if ($(elm).exists() && typeof $.fn.knob === 'function') {
      var def = {
        min: 0
      },
        attr = opt ? extend(def, opt) : def;
      $(elm).each(function () {
        $(this).knob(attr);
      });
    }
  };

  App.Knob.init = function () {
    var knob = {
      "default": {
        readOnly: true,
        lineCap: "round"
      },
      half: {
        angleOffset: -90,
        angleArc: 180,
        readOnly: true,
        lineCap: "round"
      }
    };

    App.Knob('.knob', knob["default"]);
    App.Knob('.knob-half', knob.half);
  };

  App.Range = function (elm, opt) {
    if ($(elm).exists() && typeof noUiSlider !== 'undefined') {
      $(elm).each(function () {
        var $self = $(this);
        var self_id = $self.attr('id');

        var _start = $self.data('start');
        _start = /\s/g.test(_start) ? _start.split(' ') : _start;
        _start = _start ? _start : 0;
        var _connect = $self.data('connect');
        _connect = /\s/g.test(_connect) ? _connect.split(' ') : _connect;
        _connect = typeof _connect == 'undefined' ? 'lower' : _connect;
        var _min = $self.data('min');
        _min = _min ? _min : 0;
        var _max = $self.data('max');
        _max = _max ? _max : 100;
        var _min_distance = $self.data('min-distance');
        _min_distance = _min_distance ? _min_distance : null;
        var _max_distance = $self.data('max-distance');
        _max_distance = _max_distance ? _max_distance : null;
        var _step = $self.data('step');
        _step = _step ? _step : 1;
        var _orientation = $self.data('orientation');
        _orientation = _orientation ? _orientation : 'horizontal';
        var _tooltip = $self.data('tooltip');
        _tooltip = _tooltip ? _tooltip : false;

        var target = document.getElementById(self_id);
        var def = {
          start: _start,
          connect: _connect,
          direction: App.State.isRTL ? "rtl" : "ltr",
          range: {
            'min': _min,
            'max': _max
          },
          margin: _min_distance,
          limit: _max_distance,
          step: _step,
          orientation: _orientation,
          tooltips: _tooltip
        };

        var attr = opt ? extend(def, opt) : def;
        noUiSlider.create(target, attr);
      });
    }
  };

  App.Range.init = function () {
    App.Range('.form-control-slider');
    App.Range('.form-range-slider');
  };

  App.Select2.init = function () {
    App.Select2('.js-select2');
  };

  App.Slick = function (elm, opt) {
    if ($(elm).exists() && typeof $.fn.slick === 'function') {
      $(elm).each(function () {
        var def = {
          'prevArrow':
            '<div class="slick-arrow-prev"><a href="javascript:void(0);" ' +
            'class="slick-prev"><em class="icon ni ni-chevron-left"></em></a></div>',
          'nextArrow':
            '<div class="slick-arrow-next"><a href="javascript:void(0);" ' +
            'class="slick-next"><em class="icon ni ni-chevron-right"></em></a></div>',
          rtl: App.State.isRTL
        };
        var attr = opt ? extend(def, opt) : def;

        $(this).slick(attr);
      });
    }
  };

  App.Slider.init = function () {
    App.Slick('.slider-init');
  };

  App.Lightbox = function (elm, type, opt) {
    if ($(elm).exists()) {
      $(elm).each(function () {
        var def = {};

        if (type == 'video' || type == 'iframe') {
          def = {
            type: 'iframe',
            removalDelay: 160,
            preloader: true,
            fixedContentPos: false,
            callbacks: {
              beforeOpen: function beforeOpen() {
                this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                this.st.mainClass = this.st.el.attr('data-effect');
              }
            }
          };
        } else if (type == 'content') {
          def = {
            type: 'inline',
            preloader: true,
            removalDelay: 400,
            mainClass: 'mfp-fade content-popup'
          };
        } else {
          def = {
            type: 'image',
            mainClass: 'mfp-fade image-popup'
          };
        }

        var attr = opt ? extend(def, opt) : def;
        $(this).magnificPopup(attr);
      });
    }
  };

  App.Control = function (elm) {
    var control = document.querySelectorAll(elm);

    control.forEach(function (item, _index, _arr) {
      if (item.checked) {
        item.parentNode.classList.add('checked');
      }

      item.addEventListener("change", function () {
        if (item.type == "checkbox") {
          if (item.checked) {
            item.parentNode.classList.add('checked');
          } else {
            item.parentNode.classList.remove('checked');
          }
        }

        if (item.type == "radio") {
          document.querySelectorAll('input[name="' + item.name + '"]').forEach(
            function (item, _index, _arr) {
              item.parentNode.classList.remove('checked');
            }
          );

          if (item.checked) {
            item.parentNode.classList.add('checked');
          }
        }
      });
    });
  };

  App.NumberSpinner = function (_elm, _opt) {
    var plus = document.querySelectorAll("[data-number='plus']");
    var minus = document.querySelectorAll("[data-number='minus']");

    plus.forEach(function (_item, index, _arr) {

      plus[index].addEventListener("click", function () {
        var child = plus[index].parentNode.children;

        child.forEach(function (_item, index, _arr) {
          if (child[index].classList.contains("number-spinner")) {
            var value = child[index].value !== "" ? parseInt(child[index].value) : 0;
            var step = child[index].step !== "" ? parseInt(child[index].step) : 1;
            var max = child[index].max !== "" ? parseInt(child[index].max) : Infinity;

            if (max + 1 > value + step) {
              child[index].value = value + step;
            } else {
              child[index].value = value;
            }
          }
        });
      });
    });

    minus.forEach(function (_item, index, _arr) {
      minus[index].addEventListener("click", function () {
        var child = minus[index].parentNode.children;

        child.forEach(function (_item, index, _arr) {
          if (child[index].classList.contains("number-spinner")) {
            var value = child[index].value !== "" ? parseInt(child[index].value) : 0;
            var step = child[index].step !== "" ? parseInt(child[index].step) : 1;
            var min = child[index].min !== "" ? parseInt(child[index].min) : 0;

            if (min - 1 < value - step) {
              child[index].value = value - step;
            } else {
              child[index].value = value;
            }
          }
        });
      });
    });
  };

  App.Stepper = function (elm, opt) {
    var element = document.querySelectorAll(elm);

    if (element.length > 0) {
      element.forEach(function (item, _index) {
        var def = {
          selectors: {
            nav: 'stepper-nav',
            progress: 'stepper-progress',
            content: 'stepper-steps',
            prev: 'step-prev',
            next: 'step-next',
            submit: 'step-submit'
          },
          classes: {
            nav_current: 'current',
            nav_done: 'done',
            step_active: 'active',
            step_done: 'done',
            active_step: 'active'
          },
          current_step: 1
        };
        var attr = opt ? extend(def, opt) : def;

        App.Custom.Stepper(item, attr);
        App.Validate.OnChange('.js-select2');
        App.Validate.OnChange('.date-picker');
        App.Validate.OnChange('.js-tagify');
      });
    }
  };

  App.Stepper.init = function () {
    App.Stepper('.stepper-init');
  };

  App.Tagify = function (elm, opt) {
    if ($(elm).exists() && typeof $.fn.tagify === 'function') {
      var def,
        attr = opt ? extend(def, opt) : def;
      $(elm).tagify(attr);
    }
  };

  App.Tagify.init = function () {
    App.Tagify('.js-tagify');
  };

  function showAlert(text, confirm, action) {
    Swal.fire({
      icon: 'warning',
      title: 'Apakah kamu yakin?',
      text: text,
      showCancelButton: true,
      confirmButtonText: confirm,
      cancelButtonText: 'Batal'
    }).then(function (result) {
      if (result.value) {
        action();
      }
    });
  }

  function timeReading(message, add) {
    var wpm = 120;
    var words = message.trim().split(/\s+/).length;
    var time = (words / wpm) * 60000;

    return time + Number(add);
  }

  App.FlashData = function () {
    var flashdata = document.getElementById('flashdata');

    if (flashdata) {
      var types = ['error', 'success'];

      flashdata = JSON.parse(flashdata.innerHTML);
      flashdata = window.constants = Object.assign(flashdata, window.constants || {});

      for (var i = 0; i < types.length; i++) {
        if (!(types[i] in flashdata)) {
          continue;
        }

        if (typeof window.toastr !== 'undefined') {
          var message = flashdata[types[i]];

          window.toastr.clear();
          App.Toast(message, types[i], {
            position: 'bottom-right',
            timeOut: timeReading(message, 5000),
          });
        }
      }
    }
  };

  App.Crud = function () {
    var $doc = $(document);
    var $current = window.location.origin.concat(window.location.pathname).replace(/\/$/, '');

    $doc.on('click', '[data-action="delete"]', function (evt) {
      evt.preventDefault();
      var id = $(this).data('id');

      showAlert(
        'Data tersebut akan terhapus dan tidak bisa dikembalikan.',
        'Ya, hapus!',
        function () {
          window.location.href = $current + '/delete/' + id;
        }
      );
    });

    $doc.on('click', '.add-button', function (evt) {
      evt.preventDefault();
      console.log('add');

      var $form = $('#form-modal form');
      var $title = $form.data('page');
      var $insert = $current + '/insert';

      $form
        .find('input:not([type="hidden"]), select, textarea, input[type="radio"]')
        .each(function () {
          var tag = $(this).prop('tagName').toLowerCase();
          var type = $(this).attr('type');
          var value = $(this).data('default') || ''

          switch (tag) {
            case 'input':
              if (type === 'radio') {
                $(this).prop('checked', Boolean(value));
              } else {
                $(this).val(value);
              }
              break;

            case 'select':
              $(this).val(value).change().trigger('change');
              break;

            case 'textarea':
              $(this).html(value);
              break;
          }
        });

      $('#form-modal .modal-title').text($form.data('title') || 'Tambah ' + $title);
      $form.attr('action', $insert);
    });

    $doc.on('click', '.edit-button', function (evt) {
      evt.preventDefault();
      console.log('edit');

      var $form = $('#form-modal form');
      var $title = $form.data('page');
      var $update = $current + '/update/' + $(this).data('id');
      var $data = $(this).data();

      for (var i = 0; i < Object.keys($data).length; i++) {
        var key = Object.keys($data)[i];

        if (/^(bs|value_)/.test(key)) {
          continue;
        }

        if (!['id', 'title'].includes(key)) {
          var original = key;

          if (typeof $data['value_' + key] !== 'undefined') {
            key = 'value_' + key;
          }

          var name = '[name="' + original + '"]';
          var value = $data[key];

          $form.find('input' + name + ':not([type="radio"], [type="checkbox"])').val(value);
          $form.find('select' + name).val(value).change().trigger('change');
          $form.find('textarea' + name).html(value);
          $form.find('input[type="radio"]' + name).prop('checked', false);
          $form.find('input[type="radio"]' + name + '[value="' + value + '"]').prop('checked', true);
          $form.find('input[type="checkbox"]' + name).prop('checked', value);
        }
      }

      $('#form-modal .modal-title').text($form.data('title') || 'Ubah ' + $title);
      $form.attr('action', $update);
    });
  };

  App.LinkList = function () {
    var current = window.location.href;
    var path = current.substring(0, current.indexOf('#') == -1 ? current.length : current.indexOf('#'));
    path = path.substring(0, path.indexOf('?') == -1 ? path.length : path.indexOf('?'));

    $('ul.link-list-menu > li > a').each(function () {
      var href = $(this).attr('href');
      $(this).removeClass('active');

      if (path.match(href)) {
        $(this).addClass('active');
      }
    });
  };

  App.AutoHeight = function () {
    $('textarea.auto-height').on('input', function () {
      this.style.height = 'auto';
      this.style.height = (this.scrollHeight + 1.5) + 'px';
    });
  };

  App.OtherInit = function () {
    App.ClassBody();
    App.PassSwitch();
    App.CurrentLink();
    App.LinkOff('.is-disable');
    App.ClassNavMenu();
    App.SetHW('[data-height]', 'height');
    App.SetHW('[data-width]', 'width');
    App.NumberSpinner();
    App.Lightbox('.popup-video', 'video');
    App.Lightbox('.popup-iframe', 'iframe');
    App.Lightbox('.popup-image', 'image');
    App.Lightbox('.popup-content', 'content');
    App.Control('.custom-control-input');
    App.FlashData();
    App.Crud();
    App.LinkList();
    App.AutoHeight();
  };

  App.Ani.init = function () {
    App.Ani.formElm('.form-control-outlined');
    App.Ani.formSearch('.toggle-search');
  };

  App.BS.init = function () {
    App.BS.menutip('a.waska-menu-link');
    App.BS.tooltip('.waska-tooltip');
    App.BS.tooltip('.btn-tooltip', {
      placement: 'top'
    });
    App.BS.tooltip('[data-toggle="tooltip"]');
    App.BS.tooltip('[data-bs-toggle="tooltip"]');
    App.BS.tooltip('.tipinfo,.waska-menu-tooltip', {
      placement: 'right'
    });
    App.BS.popover('[data-toggle="popover"]');
    App.BS.popover('[data-bs-toggle="popover"]');
    App.BS.progress('[data-progress]');
    App.BS.fileinput('.form-file-input');
    App.BS.modalfix();
    App.BS.ddfix();
    App.BS.tabfix();
  };

  App.Picker.init = function () {
    App.Picker.date('.date-picker');
    App.Picker.dob('.date-picker-alt');
    App.Picker.time('.time-picker');
    App.Picker.date('.date-picker-range', {
      todayHighlight: false,
      autoclose: false
    });
  };

  App.Addons.Init = function () {
    App.Knob.init();
    App.Range.init();
    App.Select2.init();
    App.Dropzone.init();
    App.Slider.init();
    App.DataTable.init();
    App.Tagify.init();
  };

  App.TGL.init = function () {
    App.TGL.content('.toggle');
    App.TGL.expand('.toggle-expand');
    App.TGL.expand('.toggle-opt', {
      toggle: false
    });
    App.TGL.showmenu('.waska-nav-toggle');
    App.TGL.ddmenu('.' + _menu + '-toggle', {
      self: _menu + '-toggle',
      child: _menu + '-sub'
    });
  };

  App.BS.modalOnInit = function () {
    $('.modal').on('shown.bs.modal', function () {
      App.Select2.init();
      App.Validate.init();
    });
  };

  App.init = function () {
    App.coms.docReady.push(App.OtherInit);
    App.coms.docReady.push(App.Ani.init);
    App.coms.docReady.push(App.TGL.init);
    App.coms.docReady.push(App.BS.init);
    App.coms.docReady.push(App.Validate.init);
    App.coms.docReady.push(App.Picker.init);
    App.coms.docReady.push(App.Addons.Init);
    App.coms.docReady.push(App.Wizard);
    App.coms.docReady.push(App.sbCompact);
    App.coms.docReady.push(App.Stepper.init);
    App.coms.winLoad.push(App.ModeSwitch);
  };

  App.init();
  return App;
}

run(App, jQuery);
