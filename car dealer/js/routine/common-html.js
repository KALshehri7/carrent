let cHTML = new CommonTemplate();
let util = new CommonUtil();
let CommonHTML = (function () {
  // regular variables and jquery variables here
  let headSel = {},
      sidebarMenuItemSel = {},
      pageWrapperSel = {},
      bodyElem = {},
      mainWrapperSel = {},
      confirmModalLogoutSel = {};

  let fnCommonElement = {},
      fnHeaderAndFooterElem = {},
      fnPageTitle = {},
      fnManipulateRecordElem = {};

  let carDealerUsernameSel = {},
      carDealerTableSel = {},
      carTableSel = {},
      priceColumnSel = {},
      mileageColumnSel = {};


  return {

    /**
     * All the elements required before an
     * event occurred must be in the init function.
     */
    init: function () {

      // initialize regular variables and jquery variables from the top
      headSel = $('head');
      sidebarMenuItemSel = $(".templatemo-sidebar-menu li");
      pageWrapperSel = $(".template-page-wrapper");
      mainWrapperSel = $("#main-wrapper");
      carDealerUsernameSel = $('#carDealer-username');
      carDealerTableSel = $('#carDealer-table');
      carTableSel = $('#vehicle-table');
      priceColumnSel = $("#vehicle-table > tbody > tr > td:nth-child(6)");
      mileageColumnSel = $("#vehicle-table > tbody > tr > td:nth-child(8)");

      bodyElem = $('body');
      confirmModalLogoutSel = {};
      fnCommonElement = null;
      fnHeaderAndFooterElem = null;
      fnPageTitle = null;
      fnManipulateRecordElem = null;


      // call the event driven functions here
      this.bindCarActionFn();
    },
    bindCarActionFn: function () {

      fnCommonElement = function () {                                            // contents
        mainWrapperSel.prepend(CarDealerPageTemplate.navBar());
        pageWrapperSel.prepend(CarDealerPageTemplate.sideBar(carDealerUsernameSel.val()));     // sidebar
        pageWrapperSel.last().append(CarDealerPageTemplate.footer());
        pageWrapperSel.append(CarDealerPageTemplate.logoutModal());                        // confirm logout
      };

      fnHeaderAndFooterElem = function () {                   // contents
        mainWrapperSel.prepend(CarDealerPageTemplate.navBar());
        mainWrapperSel.last().append(CarDealerPageTemplate.footer());
      };

      fnManipulateRecordElem = function () {
        pageWrapperSel.append(cHTML.confirmDeleteRecord());
        pageWrapperSel.append(cHTML.rowAffectedSuccessfully());
      };


      // console.log(util.getFilename());

      switch (util.getFilename()) {
        case util.pageName[util.pageEnum.dashboard].name:
          fnCommonElement();
          break;
        case util.pageName[util.pageEnum.inventory].name:
          fnCommonElement();
          fnManipulateRecordElem();
          break;
        case util.pageName[util.pageEnum.orders].name:
          fnCommonElement();
          fnManipulateRecordElem();
          break;
        case util.pageName[util.pageEnum.preferences].name:
          fnCommonElement();
          break;
        case util.pageName[util.pageEnum.login].name:
          fnHeaderAndFooterElem();
          break;
        case util.pageName[util.pageEnum.register].name:
          fnHeaderAndFooterElem();
          break;
        case util.pageName[util.pageEnum.updateCar].name:
          fnCommonElement();
          break;
        default:
      }
    }
  };
})();