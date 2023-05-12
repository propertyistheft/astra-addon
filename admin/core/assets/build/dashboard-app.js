/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/dashboard-app/SettingsSavedNotification.js":
/*!***************************************************************!*\
  !*** ./assets/src/dashboard-app/SettingsSavedNotification.js ***!
  \***************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _headlessui_react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @headlessui/react */ "./node_modules/@headlessui/react/dist/components/transitions/transition.js");
/* harmony import */ var _heroicons_react_outline__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @heroicons/react/outline */ "./node_modules/@heroicons/react/outline/esm/CheckCircleIcon.js");
/* harmony import */ var _heroicons_react_solid__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @heroicons/react/solid */ "./node_modules/@heroicons/react/solid/esm/XIcon.js");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);







const SettingsSavedNotification = () => {
  const [displayNotification, setDisplayNotification] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)(true);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    "aria-live": "assertive",
    className: "fixed inset-10 z-10 flex px-4 py-6 pointer-events-none sm:p-6 sm:items-start"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "w-full flex flex-col items-center space-y-4 sm:items-end"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_headlessui_react__WEBPACK_IMPORTED_MODULE_3__.Transition, {
    show: displayNotification,
    as: react__WEBPACK_IMPORTED_MODULE_1__.Fragment,
    enter: "transform ease-out duration-300 transition",
    enterFrom: "translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2",
    enterTo: "translate-y-0 opacity-100 sm:translate-x-0",
    leave: "transition ease-in duration-100",
    leaveFrom: "opacity-100",
    leaveTo: "opacity-0"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "p-4"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flex items-start"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flex-shrink-0"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_heroicons_react_outline__WEBPACK_IMPORTED_MODULE_4__["default"], {
    className: "h-6 w-6 text-green-400",
    "aria-hidden": "true"
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "ml-3 w-0 flex-1 pt-0.5"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "text-sm font-medium text-gray-900"
  }, " ", (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Successfully saved!', 'astra-addon'), " ")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "ml-4 flex-shrink-0 flex"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500",
    onClick: () => {
      setDisplayNotification(false);
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "sr-only"
  }, " ", (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Close ', 'astra-addon'), " "), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_heroicons_react_solid__WEBPACK_IMPORTED_MODULE_5__["default"], {
    className: "h-5 w-5",
    "aria-hidden": "true"
  }))))))))));
};
/* harmony default export */ __webpack_exports__["default"] = (SettingsSavedNotification);

/***/ }),

/***/ "./assets/src/dashboard-app/pages/settings/AssetReGeneration.js":
/*!**********************************************************************!*\
  !*** ./assets/src/dashboard-app/pages/settings/AssetReGeneration.js ***!
  \**********************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _AddonDashboardApp_SettingsSavedNotification__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @AddonDashboardApp/SettingsSavedNotification */ "./assets/src/dashboard-app/SettingsSavedNotification.js");





const AssetReGeneration = () => {
  const [showSettingsNotification, setShowSettingsNotification] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)(false);
  const [regenerateAssetsState, setRegenerateAssetsState] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)(false);
  const regenerateLocalFontAssets = () => {
    setRegenerateAssetsState('loading');
    const formData = new window.FormData();
    formData.append('action', 'astra_refresh_assets_files');
    formData.append('security', astra_addon_admin.update_nonce);
    _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3___default()({
      url: astra_admin.ajax_url,
      method: 'POST',
      body: formData
    }).then(response => {
      setRegenerateAssetsState(false);
      setShowSettingsNotification(true);
      setTimeout(() => {
        setShowSettingsNotification(false);
      }, 2000);
    });
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("section", {
    className: `astra-child-field block px-8 py-8 justify-between`
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "w-full flex items-center"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    className: "p-0 flex-1 inline-flex justify-right text-xl leading-6 font-semibold text-slate-800"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Asset Regeneration", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flex justify-right items-center"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    type: "button",
    className: "inline-flex px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-astra focus-visible:bg-astra-hover hover:bg-astra-hover focus:outline-none",
    onClick: regenerateLocalFontAssets
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Regenerate Assets", "astra-addon"), 'loading' === regenerateAssetsState && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    className: "animate-spin -mr-1 ml-3 h-5 w-5 text-white",
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 24 24"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("circle", {
    className: "opacity-25",
    cx: "12",
    cy: "12",
    r: "10",
    stroke: "currentColor",
    strokeWidth: "4"
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    className: "opacity-75",
    fill: "currentColor",
    d: "M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
  }))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "mt-2 text-sm text-slate-600 w-9/12 tablet:w-full"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Facing issues with style, layout, color or another page element? Use this option to regenerate CSS and Javascript assets. It can help with all kinds of asset issues.', 'astra-addon'))), showSettingsNotification && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_SettingsSavedNotification__WEBPACK_IMPORTED_MODULE_4__["default"], null));
};
/* harmony default export */ __webpack_exports__["default"] = (AssetReGeneration);

/***/ }),

/***/ "./assets/src/dashboard-app/pages/settings/BetaUpdates.js":
/*!****************************************************************!*\
  !*** ./assets/src/dashboard-app/pages/settings/BetaUpdates.js ***!
  \****************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _headlessui_react__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @headlessui/react */ "./node_modules/@headlessui/react/dist/components/switch/switch.js");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _AddonDashboardApp_SettingsSavedNotification__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @AddonDashboardApp/SettingsSavedNotification */ "./assets/src/dashboard-app/SettingsSavedNotification.js");






function classNames() {
  for (var _len = arguments.length, classes = new Array(_len), _key = 0; _key < _len; _key++) {
    classes[_key] = arguments[_key];
  }
  return classes.filter(Boolean).join(' ');
}
const BetaUpdates = () => {
  const enableBeta = 'disable' === astra_addon_admin.enable_beta ? false : true;
  const [enableBetaStatus, setEnableBetaStatus] = (0,react__WEBPACK_IMPORTED_MODULE_2__.useState)(enableBeta);
  const [showSettingsNotification, setShowSettingsNotification] = (0,react__WEBPACK_IMPORTED_MODULE_2__.useState)(false);
  const updateEnableBetaStatus = () => {
    let assetStatus;
    if (enableBetaStatus) {
      assetStatus = 'disable';
    } else {
      assetStatus = 'enable';
    }
    setEnableBetaStatus(!enableBetaStatus);
    const formData = new window.FormData();
    formData.append('action', 'astra_beta_updates');
    formData.append('security', astra_addon_admin.update_nonce);
    formData.append('status', assetStatus);
    _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3___default()({
      url: astra_admin.ajax_url,
      method: 'POST',
      body: formData
    }).then(response => {
      if (response.success) {
        window.astra_addon_admin.enable_beta = assetStatus;
        setShowSettingsNotification(true);
        setTimeout(() => {
          setShowSettingsNotification(false);
        }, 2000);
      }
    });
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("section", {
    className: "block border-b border-solid border-slate-200 px-8 py-8 justify-between"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mr-16 w-full flex items-center"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    className: "p-0 flex-1 justify-right inline-flex text-xl leading-8 font-semibold text-slate-800"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Enable Beta', 'astra-addon')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_headlessui_react__WEBPACK_IMPORTED_MODULE_5__.Switch, {
    checked: enableBetaStatus,
    onChange: updateEnableBetaStatus,
    className: classNames(enableBetaStatus ? 'bg-astra' : 'bg-slate-200', 'group relative inline-flex h-4 w-9 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-astra focus:ring-offset-2')
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    "aria-hidden": "true",
    className: "pointer-events-none absolute h-full w-full rounded-md bg-white"
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    "aria-hidden": "true",
    className: classNames(enableBetaStatus ? 'bg-astra' : 'bg-gray-200', 'pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out')
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    "aria-hidden": "true",
    className: classNames(enableBetaStatus ? 'translate-x-5' : 'translate-x-0', 'toggle-bubble pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-gray-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out')
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "mt-2 w-full text-sm text-slate-500"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Enable this option to receive update notifications for beta versions. Please read ', 'astra-addon'), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
    className: "text-astra focus:text-astra-hover active:text-astra-hover hover:text-astra-hover underline",
    href: "https://wpastra.com/docs/automatic-beta-updates-for-astra/?utm_source=wp&utm_medium=dashboard",
    target: "_blank",
    rel: "noreferrer"
  }, " ", (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('this article', 'astra-addon'), " "), (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)(' to know more.', 'astra-addon'))), showSettingsNotification && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_SettingsSavedNotification__WEBPACK_IMPORTED_MODULE_4__["default"], null));
};
/* harmony default export */ __webpack_exports__["default"] = (BetaUpdates);

/***/ }),

/***/ "./assets/src/dashboard-app/pages/settings/FileGeneration.js":
/*!*******************************************************************!*\
  !*** ./assets/src/dashboard-app/pages/settings/FileGeneration.js ***!
  \*******************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _headlessui_react__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @headlessui/react */ "./node_modules/@headlessui/react/dist/components/switch/switch.js");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _AddonDashboardApp_SettingsSavedNotification__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @AddonDashboardApp/SettingsSavedNotification */ "./assets/src/dashboard-app/SettingsSavedNotification.js");






function classNames() {
  for (var _len = arguments.length, classes = new Array(_len), _key = 0; _key < _len; _key++) {
    classes[_key] = arguments[_key];
  }
  return classes.filter(Boolean).join(' ');
}
const FileGeneration = () => {
  const enableFileGeneration = 'disable' === astra_addon_admin.enable_file_generation ? false : true;
  const [fileGenerationStatus, setFileGenerationStatus] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)(enableFileGeneration);
  const [showSettingsNotification, setShowSettingsNotification] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)(false);
  const updateFileGenerationStatus = () => {
    let assetStatus;
    if (fileGenerationStatus) {
      assetStatus = 'disable';
    } else {
      assetStatus = 'enable';
    }
    setFileGenerationStatus(!fileGenerationStatus);
    const formData = new window.FormData();
    formData.append('action', 'astra_file_generation');
    formData.append('security', astra_addon_admin.update_nonce);
    formData.append('status', assetStatus);
    _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3___default()({
      url: astra_admin.ajax_url,
      method: 'POST',
      body: formData
    }).then(response => {
      if (response.success) {
        window.astra_addon_admin.enable_file_generation = assetStatus;
        setShowSettingsNotification(true);
        setTimeout(() => {
          setShowSettingsNotification(false);
        }, 2000);
      }
    });
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("section", {
    className: `astra-parent-field-${fileGenerationStatus} block px-8 py-8 justify-between`
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mr-16 w-full flex items-center"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    className: "p-0 flex-1 justify-right inline-flex text-xl leading-8 font-semibold text-slate-800"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("File Generation", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_headlessui_react__WEBPACK_IMPORTED_MODULE_5__.Switch, {
    checked: fileGenerationStatus,
    onChange: updateFileGenerationStatus,
    className: classNames(fileGenerationStatus ? 'bg-astra' : 'bg-slate-200', 'group relative inline-flex h-4 w-9 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-astra focus:ring-offset-2')
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    "aria-hidden": "true",
    className: "pointer-events-none absolute h-full w-full rounded-md bg-white"
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    "aria-hidden": "true",
    className: classNames(fileGenerationStatus ? 'bg-astra' : 'bg-gray-200', 'pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out')
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    "aria-hidden": "true",
    className: classNames(fileGenerationStatus ? 'translate-x-5' : 'translate-x-0', 'toggle-bubble pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-gray-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out')
  }))), astra_admin.show_self_branding && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "mt-2 w-9/12 text-sm text-slate-500 tablet:w-full"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)(`${astra_admin.theme_name} loads the CSS and JS inline on the page by default. If you want to generate separate CSS and JS files for individual addons, enable this option. Please read `, "astra-addon"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
    className: "text-astra focus:text-astra-hover active:text-astra-hover hover:text-astra-hover underline",
    href: "https://wpastra.com/astra-2-1/?utm_source=wp&utm_medium=dashboard",
    target: "_blank",
    rel: "noreferrer"
  }, " ", (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('this article', 'astra-addon'), " "), (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)(' to learn the difference between generating CSS and JS inline and in a separate file.', 'astra-addon')), !astra_admin.show_self_branding && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "mt-2 w-9/12 text-sm text-slate-500 tablet:w-full"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)(`${astra_admin.theme_name} loads the CSS and JS inline on the page by default. If you want to generate separate CSS and JS files for individual addons, enable this option.`, "astra-addon"))), showSettingsNotification && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_SettingsSavedNotification__WEBPACK_IMPORTED_MODULE_4__["default"], null));
};
/* harmony default export */ __webpack_exports__["default"] = (FileGeneration);

/***/ }),

/***/ "./assets/src/dashboard-app/pages/settings/LicenseKey.js":
/*!***************************************************************!*\
  !*** ./assets/src/dashboard-app/pages/settings/LicenseKey.js ***!
  \***************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _AddonDashboardApp_pages_settings_LicensingNotification__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @AddonDashboardApp/pages/settings/LicensingNotification */ "./assets/src/dashboard-app/pages/settings/LicensingNotification.js");





const LicenseKey = () => {
  const licenseStatus = astra_addon_admin.license_status;
  const licenseTriggerName = licenseStatus ? 'bsf_deactivate_license' : 'bsf_activate_license';
  const [inputStatus, setInputStatus] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)(licenseStatus ? 'activated' : '');
  const licenseTitle = licenseStatus ? (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Deactivate', 'astra-addon') : (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Activate', 'astra-addon');
  const licensePlaceholder = licenseStatus ? (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Your license is active.', 'astra-addon') : (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Paste your license key here', 'astra-addon');
  const licenseMessage = licenseStatus ? (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('You are using', 'astra-addon') : (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)(`Please enter your valid license key below to activate ${astra_admin.plugin_name}!`, "astra-addon");
  const [showLicenseNotification, setLicenseNotification] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)(false);
  const [licenseReply, setLicenseReply] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)('');
  const [verifyingLicenseState, setVerifyLicenseState] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)(false);
  const validateLicense = e => {
    e.preventDefault();
    setVerifyLicenseState('loading');
    if ('deactivate' === e.target.dataset.trigger) {
      document.getElementById("bsf-astra-license-form").submit();
    } else {
      _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3___default()({
        path: `/bsf-core/v1/license/${e.target.dataset.trigger}`,
        method: 'POST',
        data: {
          'license-key': inputStatus,
          'product-id': 'astra-addon'
        }
      }).then(async response => {
        setVerifyLicenseState(false);
        setLicenseReply(response.message);
        setLicenseNotification(true);
        setTimeout(() => {
          setLicenseNotification(false);
        }, 2000);
        if (response.success) {
          location.reload();
        }
      });
    }
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("section", {
    className: "ast-licensing-wrap block border-b border-solid border-slate-200 px-8 py-8 justify-between"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mr-16 w-full"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("form", {
    method: "post",
    id: "bsf-astra-license-form",
    className: "form-wrap bsf-license-register-astra-addon form-submited-astra-addon"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    className: "flex items-center mb-4 p-0 text-xl leading-6 font-semibold text-slate-800"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    width: "20",
    height: "20",
    viewBox: "0 0 20 20",
    className: "mr-2",
    fill: "none",
    xmlns: "http://www.w3.org/2000/svg"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M6.66683 9.16667V5.83333C6.66683 3.99238 8.15921 2.5 10.0002 2.5C11.8411 2.5 13.3335 3.99238 13.3335 5.83333M10.0002 12.5V14.1667M5.00016 17.5H15.0002C15.9206 17.5 16.6668 16.7538 16.6668 15.8333V10.8333C16.6668 9.91286 15.9206 9.16667 15.0002 9.16667H5.00016C4.07969 9.16667 3.3335 9.91286 3.3335 10.8333V15.8333C3.3335 16.7538 4.07969 17.5 5.00016 17.5Z",
    stroke: "#1E293B",
    strokeWidth: "1.4",
    strokeLinecap: "round"
  })), (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Your License", "astra-addon")), !licenseStatus && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "text-sm text-slate-600"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Activate ', 'astra-addon'), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
    href: astra_admin.show_self_branding ? astra_admin.upgrade_url : astra_addon_admin.agency_license_link,
    className: "text-astra font-medium underline",
    target: "_blank"
  }, astra_admin.plugin_name), " ", (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)(' addon to get professional support and automatic updates from your WordPress dashboard.', 'astra-addon')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mt-2"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "bsf_license_manager[license_key]",
    className: "block mb-4 text-sm text-slate-500"
  }, licenseMessage, " ", licenseStatus ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "font-medium"
  }, " ", astra_admin.theme_name, " + ", astra_admin.plugin_name, ". ") : ''), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flex flex-col sm:flex-row"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "relative"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "hidden",
    id: "bsf_graupi_nonce",
    name: "bsf_graupi_nonce",
    value: astra_addon_admin.bsf_graupi_nonce
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "hidden",
    name: "_wp_http_referer",
    value: window.location.href.replace(window.location.origin, '')
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "hidden",
    name: licenseTriggerName,
    value: ""
  }),
  // Added this because to avoid value={} attr to license input field as this won't make input typeable.
  licenseStatus && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "hidden",
    id: "bsf_license_manager[license_key]",
    name: "bsf_license_manager[license_key]",
    value: licensePlaceholder
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    className: "ast-admin_license-input-field h-10 block w-[28rem] shadow-sm focus:border-astra focus:ring-astra sm:text-sm text-slate-400",
    id: licenseStatus ? 'astra_addon_license_key' : "bsf_license_manager[license_key]",
    name: licenseStatus ? 'astra_addon_license_key' : "bsf_license_manager[license_key]",
    type: "text",
    placeholder: licensePlaceholder,
    readOnly: licenseStatus ? true : false,
    onChange: e => setInputStatus(e.target.value)
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    width: "16",
    height: "16",
    viewBox: "0 0 16 16",
    fill: "none",
    xmlns: "http://www.w3.org/2000/svg",
    className: "absolute top-1/2 -translate-y-1/2 left-3"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M10 4.66667C10.7364 4.66667 11.3333 5.26362 11.3333 6M14 6C14 8.20914 12.2091 10 10 10C9.59589 10 9.20577 9.94007 8.83805 9.82862L7.33333 11.3333H6V12.6667H4.66667V14H2.66667C2.29848 14 2 13.7015 2 13.3333V11.6095C2 11.4327 2.07024 11.2631 2.19526 11.1381L6.17138 7.16195C6.05993 6.79423 6 6.40412 6 6C6 3.79086 7.79086 2 10 2C12.2091 2 14 3.79086 14 6Z",
    stroke: "#94A3B8",
    strokeWidth: "1.4",
    strokeLinecap: "round",
    strokeLinejoin: "round"
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "hidden",
    id: "bsf_license_manager[product_id]",
    name: "bsf_license_manager[product_id]",
    value: astra_addon_admin.product
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    disabled: '' === inputStatus ? true : false,
    onClick: validateLicense,
    "data-trigger": licenseStatus ? 'deactivate' : 'activate',
    name: licenseTriggerName,
    className: `inline-flex items-center sm:ml-4 px-4 py-2  mt-2 sm:mt-0 text font-medium rounded-md shadow-sm ml-4 ${licenseStatus ? 'text-[#4AB866] bg-gray-50' : inputStatus === '' ? 'bg-gray-50 text-astra' : 'bg-astra text-white'}`
  }, licenseTitle, 'loading' === verifyingLicenseState && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    className: "animate-spin -mr-1 ml-3 h-5 w-5 fill-current",
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 24 24"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("circle", {
    className: "opacity-25",
    cx: "12",
    cy: "12",
    r: "10",
    stroke: "currentColor",
    strokeWidth: "4"
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    className: "opacity-75",
    fill: "currentColor",
    d: "M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
  })))))), !astra_admin.is_whitelabel && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mt-4"
  }, licenseStatus ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
    href: "https://store.brainstormforce.com/upgrades/",
    target: "_blank",
    className: "text-sm font-medium leading-[0.875rem] text-astra"
  }, " ", (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Need more license?', 'astra-addon'), " ") : (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
    href: "https://store.brainstormforce.com/support/",
    target: "_blank",
    className: "text-sm font-medium leading-[0.875rem] text-astra"
  }, " ", (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Need Help?', 'astra-addon'), " ")))), showLicenseNotification && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_pages_settings_LicensingNotification__WEBPACK_IMPORTED_MODULE_4__["default"], {
    message: licenseReply
  }));
};
/* harmony default export */ __webpack_exports__["default"] = (LicenseKey);

/***/ }),

/***/ "./assets/src/dashboard-app/pages/settings/LicensingNotification.js":
/*!**************************************************************************!*\
  !*** ./assets/src/dashboard-app/pages/settings/LicensingNotification.js ***!
  \**************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _headlessui_react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @headlessui/react */ "./node_modules/@headlessui/react/dist/components/transitions/transition.js");
/* harmony import */ var _heroicons_react_outline__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @heroicons/react/outline */ "./node_modules/@heroicons/react/outline/esm/CheckCircleIcon.js");
/* harmony import */ var _heroicons_react_solid__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @heroicons/react/solid */ "./node_modules/@heroicons/react/solid/esm/XIcon.js");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);







const LicensingNotification = props => {
  const {
    message
  } = props;
  const [displayNotification, setDisplayNotification] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)(true);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    "aria-live": "assertive",
    className: "fixed inset-10 z-10 flex px-4 py-6 pointer-events-none sm:p-6 sm:items-start"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "w-full flex flex-col items-center space-y-4 sm:items-end"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_headlessui_react__WEBPACK_IMPORTED_MODULE_3__.Transition, {
    show: displayNotification,
    as: react__WEBPACK_IMPORTED_MODULE_1__.Fragment,
    enter: "transform ease-out duration-300 transition",
    enterFrom: "translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2",
    enterTo: "translate-y-0 opacity-100 sm:translate-x-0",
    leave: "transition ease-in duration-100",
    leaveFrom: "opacity-100",
    leaveTo: "opacity-0"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "p-4"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flex items-start"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flex-shrink-0"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_heroicons_react_outline__WEBPACK_IMPORTED_MODULE_4__["default"], {
    className: "h-6 w-6 text-green-400",
    "aria-hidden": "true"
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "ml-3 w-0 flex-1 pt-0.5"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "text-sm font-medium text-gray-900"
  }, " ", message, " ")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "ml-4 flex-shrink-0 flex"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500",
    onClick: () => {
      setDisplayNotification(false);
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "sr-only"
  }, " ", (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Close ', 'astra-addon'), " "), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_heroicons_react_solid__WEBPACK_IMPORTED_MODULE_5__["default"], {
    className: "h-5 w-5",
    "aria-hidden": "true"
  }))))))))));
};
/* harmony default export */ __webpack_exports__["default"] = (LicensingNotification);

/***/ }),

/***/ "./assets/src/dashboard-app/pages/settings/RollBack.js":
/*!*************************************************************!*\
  !*** ./assets/src/dashboard-app/pages/settings/RollBack.js ***!
  \*************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _RollBackConfirmPopup__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./RollBackConfirmPopup */ "./assets/src/dashboard-app/pages/settings/RollBackConfirmPopup.js");




const RollBack = () => {
  const previousThemeVersions = astra_addon_admin.theme_versions;
  const previousAddonVersions = astra_addon_admin.addon_versions;
  const themeVersionRef = (0,react__WEBPACK_IMPORTED_MODULE_1__.useRef)(previousThemeVersions[0].value);
  const addonVersionRef = (0,react__WEBPACK_IMPORTED_MODULE_1__.useRef)(previousAddonVersions[0].value);
  const [previousVersionSelect, setPreviousVersion] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)(null);
  const [productSelect, setproductSelect] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)('astra-theme');
  const [openPopup, setopenPopup] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)(false);
  const rollbackClickHandler = e => {
    if ('addon' === e.target.dataset.product_type) {
      setPreviousVersion(addonVersionRef.current.value);
      setproductSelect('astra-addon');
    } else {
      setPreviousVersion(themeVersionRef.current.value);
      setproductSelect('astra-theme');
    }
    setopenPopup(true);
  };
  if (!astra_addon_admin.license_status) {
    return '';
  }
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("section", {
    className: "flex flex-col sm:flex-row border-b border-solid border-slate-200 px-8 py-8 justify-between"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mr-16 w-full sm:w-6/12 block items-center mb-2 sm:mb-0"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    className: "p-0 block text-xl leading-8 font-semibold text-slate-800"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Rollback to Previous Version", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "block mt-2 text-sm text-slate-500"
  },
  // eslint-disable-next-line @wordpress/i18n-no-variables
  (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)(`Experiencing an issue with current versions of software? Roll back to a previous version to help troubleshoot the issue.`, "astra-addon"))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "grid justify-items-end tablet:justify-items-start tablet:my-2"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "inline-flex w-max mb-4"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", {
    className: "mr-4 text-sm leading-8 font-medium text-slate-800"
  }, astra_admin.theme_name), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("select", {
    id: "themeVersionRollback",
    name: "themeVersionRollback",
    className: "block h-9 mr-2 sm:text-sm astra-admin__input-field astra-admin__dropdown",
    ref: themeVersionRef,
    onBlur: e => {
      setproductSelect('astra-theme');
    }
  }, previousThemeVersions.map(version => {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("option", {
      key: version.value,
      value: version.value
    }, version.label);
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    type: "button",
    className: "inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-astra transition focus:bg-astra-hover hover:bg-astra-hover focus:outline-none h-9",
    onClick: rollbackClickHandler,
    "data-product_type": "theme"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Rollback", "astra-addon"))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "inline-flex w-max"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", {
    className: "mr-4 text-sm leading-8 font-medium text-slate-800"
  }, astra_addon_admin.addon_name), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "bsf-rollback-version"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "hidden",
    name: "product-name",
    id: "bsf-product-name",
    value: astra_addon_admin.addon_name
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("select", {
    id: "addonVersionRollback",
    name: "addonVersionRollback",
    className: "bsf-rollback-version-select block h-9 mr-2 sm:text-sm astra-admin__input-field astra-admin__dropdown",
    ref: addonVersionRef,
    onBlur: e => {
      setproductSelect('astra-addon');
    }
  }, previousAddonVersions.map(version => {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("option", {
      key: version.value,
      value: version.value
    }, version.label);
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    type: "button",
    className: "bsf-rollback-button inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-astra transition focus:bg-astra-hover hover:bg-astra-hover focus:outline-none h-9",
    onClick: rollbackClickHandler,
    "data-product_type": "addon",
    "data-placeholder-url": astra_addon_admin.addon_rollback_nonce_placeholder_url
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Rollback", "astra-addon"))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_RollBackConfirmPopup__WEBPACK_IMPORTED_MODULE_3__["default"], {
    openPopup: openPopup,
    setopenPopup: setopenPopup,
    previousVersionSelect: previousVersionSelect,
    productSelect: productSelect
  }));
};
/* harmony default export */ __webpack_exports__["default"] = (RollBack);

/***/ }),

/***/ "./assets/src/dashboard-app/pages/settings/RollBackConfirmPopup.js":
/*!*************************************************************************!*\
  !*** ./assets/src/dashboard-app/pages/settings/RollBackConfirmPopup.js ***!
  \*************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _headlessui_react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @headlessui/react */ "./node_modules/@headlessui/react/dist/components/transitions/transition.js");
/* harmony import */ var _headlessui_react__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @headlessui/react */ "./node_modules/@headlessui/react/dist/components/dialog/dialog.js");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);




const RollBackConfirmPopup = props => {
  const {
    openPopup,
    setopenPopup,
    previousVersionSelect,
    productSelect
  } = props;
  const [open, setOpen] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)(openPopup);
  let productName = astra_addon_admin.rollback_theme_name;
  if ('astra-addon' === productSelect) {
    productName = astra_addon_admin.rollback_plugin_name;
  }
  const cancelButtonRef = (0,react__WEBPACK_IMPORTED_MODULE_1__.useRef)(null);
  (0,react__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    setOpen(openPopup);
  }, [openPopup]);
  const onCancelClick = () => {
    setopenPopup(!openPopup);
  };
  const onContinueClick = () => {
    let rollbackUrl = '';
    if ('astra-addon' === productName) {
      rollbackUrl = astra_addon_admin.addon_rollback_url.replace('VERSION', previousVersionSelect);
    } else {
      rollbackUrl = astra_addon_admin.theme_rollback_url.replace('VERSION', previousVersionSelect);
    }
    setopenPopup(false);
    window.location.href = rollbackUrl;
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_headlessui_react__WEBPACK_IMPORTED_MODULE_3__.Transition.Root, {
    show: open,
    as: react__WEBPACK_IMPORTED_MODULE_1__.Fragment
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_headlessui_react__WEBPACK_IMPORTED_MODULE_4__.Dialog, {
    as: "div",
    className: "ast-rollback__dialog fixed backdrop-blur-sm inset-0 overflow-y-auto",
    initialFocus: cancelButtonRef,
    onClose: setOpen
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_headlessui_react__WEBPACK_IMPORTED_MODULE_3__.Transition.Child, {
    as: react__WEBPACK_IMPORTED_MODULE_1__.Fragment,
    enter: "ease-out duration-300",
    enterFrom: "opacity-0",
    enterTo: "opacity-100",
    leave: "ease-in duration-200",
    leaveFrom: "opacity-100",
    leaveTo: "opacity-0"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "hidden sm:inline-block sm:align-middle sm:h-screen",
    "aria-hidden": "true"
  }, "\u200B"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_headlessui_react__WEBPACK_IMPORTED_MODULE_3__.Transition.Child, {
    as: react__WEBPACK_IMPORTED_MODULE_1__.Fragment,
    enter: "ease-out duration-300",
    enterFrom: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95",
    enterTo: "opacity-100 translate-y-0 sm:scale-100",
    leave: "ease-in duration-200",
    leaveFrom: "opacity-100 translate-y-0 sm:scale-100",
    leaveTo: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "sm:flex sm:items-start"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-50 sm:mx-0 sm:h-16 sm:w-16"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    className: "h-8 w-8 stroke-red-600",
    viewBox: "0 0 34 33",
    fill: "none",
    xmlns: "http://www.w3.org/2000/svg"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M17 9.83333V16.5M17 23.1667H17.0167M32 16.5C32 24.7843 25.2843 31.5 17 31.5C8.71573 31.5 2 24.7843 2 16.5C2 8.21573 8.71573 1.5 17 1.5C25.2843 1.5 32 8.21573 32 16.5Z",
    strokeWidth: "3",
    strokeLinecap: "round",
    strokeLinejoin: "round"
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_headlessui_react__WEBPACK_IMPORTED_MODULE_4__.Dialog.Title, {
    as: "h3",
    className: "text-2xl font-semibold text-slate-800"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Rollback to Previous Version', 'astra-addon')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "mt-2 text-sm text-slate-500"
  },
  // eslint-disable-next-line @wordpress/i18n-no-variables
  (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)(`Are you sure you want to rollback to ${productName} v${previousVersionSelect}?`, 'astra-addon')))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mt-6 sm:flex sm:flex-row sm:ml-20"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    type: "button",
    className: "w-full inline-flex justify-center rounded border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white focus:bg-red-700 hover:bg-red-700 focus:outline-none sm:mr-3 sm:w-auto sm:text-sm",
    onClick: onContinueClick
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Rollback', 'astra-addon')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    type: "button",
    className: "mt-3 w-full inline-flex justify-center rounded border border-slate-200 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-800 focus:bg-gray-50 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm",
    onClick: onCancelClick,
    ref: cancelButtonRef
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Cancel', 'astra-addon'))))))));
};
/* harmony default export */ __webpack_exports__["default"] = (RollBackConfirmPopup);

/***/ }),

/***/ "./assets/src/dashboard-app/pages/settings/SettingsIcons.js":
/*!******************************************************************!*\
  !*** ./assets/src/dashboard-app/pages/settings/SettingsIcons.js ***!
  \******************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

const SettingsIcons = {
  'version-control': (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    className: "flex-shrink-0 mr-4 fill-inherit",
    stroke: "none",
    width: "16",
    height: "20",
    viewBox: "0 0 16 20",
    xmlns: "http://www.w3.org/2000/svg"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M5.70711 11.2929C5.31658 10.9024 4.68342 10.9024 4.29289 11.2929C3.90237 11.6834 3.90237 12.3166 4.29289 12.7071L5.70711 11.2929ZM7 14L6.29289 14.7071C6.68342 15.0976 7.31658 15.0976 7.70711 14.7071L7 14ZM11.7071 10.7071C12.0976 10.3166 12.0976 9.68342 11.7071 9.29289C11.3166 8.90237 10.6834 8.90237 10.2929 9.29289L11.7071 10.7071ZM14 5V17H16V5H14ZM13 18H3V20H13V18ZM2 17V5H0V17H2ZM3 4H5V2H3V4ZM11 4H13V2H11V4ZM3 18C2.44772 18 2 17.5523 2 17H0C0 18.6569 1.34315 20 3 20V18ZM14 17C14 17.5523 13.5523 18 13 18V20C14.6569 20 16 18.6569 16 17H14ZM16 5C16 3.34315 14.6569 2 13 2V4C13.5523 4 14 4.44772 14 5H16ZM2 5C2 4.44772 2.44772 4 3 4V2C1.34315 2 0 3.34315 0 5H2ZM4.29289 12.7071L6.29289 14.7071L7.70711 13.2929L5.70711 11.2929L4.29289 12.7071ZM7.70711 14.7071L11.7071 10.7071L10.2929 9.29289L6.29289 13.2929L7.70711 14.7071ZM7 2H9V0H7V2ZM9 4H7V6H9V4ZM7 4C6.44772 4 6 3.55228 6 3H4C4 4.65685 5.34315 6 7 6V4ZM10 3C10 3.55228 9.55228 4 9 4V6C10.6569 6 12 4.65685 12 3H10ZM9 2C9.55228 2 10 2.44772 10 3H12C12 1.34315 10.6569 0 9 0V2ZM7 0C5.34315 0 4 1.34315 4 3H6C6 2.44772 6.44772 2 7 2V0Z"
  })),
  'white-label': (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    className: "flex-shrink-0 mr-4 stroke-inherit",
    width: "20",
    height: "20",
    viewBox: "0 0 20 20",
    fill: "none",
    xmlns: "http://www.w3.org/2000/svg"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M6.99963 10.0006L8.99963 12.0006L12.9996 8.00061M5.83437 2.69766C6.55191 2.6404 7.23309 2.35824 7.78095 1.89136C9.05944 0.801839 10.9398 0.801839 12.2183 1.89136C12.7662 2.35824 13.4474 2.6404 14.1649 2.69766C15.8393 2.83128 17.169 4.16092 17.3026 5.83535C17.3598 6.55288 17.642 7.23407 18.1089 7.78193C19.1984 9.06042 19.1984 10.9408 18.1089 12.2193C17.642 12.7672 17.3598 13.4483 17.3026 14.1659C17.169 15.8403 15.8393 17.1699 14.1649 17.3036C13.4474 17.3608 12.7662 17.643 12.2183 18.1099C10.9398 19.1994 9.05944 19.1994 7.78095 18.1099C7.23309 17.643 6.55191 17.3608 5.83437 17.3036C4.15994 17.1699 2.8303 15.8403 2.69668 14.1659C2.63942 13.4483 2.35727 12.7672 1.89038 12.2193C0.800862 10.9408 0.800862 9.06042 1.89038 7.78193C2.35727 7.23407 2.63942 6.55288 2.69668 5.83535C2.8303 4.16092 4.15994 2.83128 5.83437 2.69766Z",
    strokeWidth: "2",
    strokeLinecap: "round",
    strokeLinejoin: "round"
  }))
};
/* harmony default export */ __webpack_exports__["default"] = (SettingsIcons);

/***/ }),

/***/ "./assets/src/dashboard-app/pages/settings/WhiteLabel.js":
/*!***************************************************************!*\
  !*** ./assets/src/dashboard-app/pages/settings/WhiteLabel.js ***!
  \***************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _headlessui_react__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @headlessui/react */ "./node_modules/@headlessui/react/dist/components/switch/switch.js");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _AddonDashboardApp_SettingsSavedNotification__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @AddonDashboardApp/SettingsSavedNotification */ "./assets/src/dashboard-app/SettingsSavedNotification.js");






function classNames() {
  for (var _len = arguments.length, classes = new Array(_len), _key = 0; _key < _len; _key++) {
    classes[_key] = arguments[_key];
  }
  return classes.filter(Boolean).join(' ');
}
const WhiteLabel = () => {
  const enableWhiteLabel = astra_addon_admin.show_self_branding ? false : true;
  const [showSettingsNotification, setShowSettingsNotification] = (0,react__WEBPACK_IMPORTED_MODULE_2__.useState)(false);
  const [enableWhiteLabelStatus, setEnableWhiteLabelStatus] = (0,react__WEBPACK_IMPORTED_MODULE_2__.useState)(enableWhiteLabel);
  const updateLoadFontsLocallyStatus = () => {
    let assetStatus;
    if (enableWhiteLabelStatus) {
      assetStatus = false;
    } else {
      assetStatus = true;
    }
    setEnableWhiteLabelStatus(!enableWhiteLabelStatus);
    const formData = new window.FormData();
    formData.append('action', 'astra_addon_update_whitelabel');
    formData.append('security', astra_addon_admin.update_nonce);
    formData.append('key', 'hide_branding');
    formData.append('parent', 'astra-agency');
    formData.append('value', assetStatus);
    _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3___default()({
      url: astra_admin.ajax_url,
      method: 'POST',
      body: formData
    }).then(response => {
      if (response.success) {
        window.astra_addon_admin.show_self_branding = assetStatus;
        setShowSettingsNotification(true);
        setTimeout(() => {
          setShowSettingsNotification(false);
          let newThemeName = response.data.rebranded_theme_name,
            pureName = newThemeName.replaceAll('%', '');
          window.open(`${astra_admin.admin_url}?page=${pureName.toLowerCase()}&path=settings`, '_self');
        }, 500);
      }
    });
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("section", {
    className: "block border-b border-t border-solid border-slate-200 px-8 py-8 justify-between"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mr-16 w-full flex items-center"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    className: "p-0 flex-1 justify-right inline-flex text-xl leading-8 font-semibold text-slate-800"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Enable White Label', 'astra-addon')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_headlessui_react__WEBPACK_IMPORTED_MODULE_5__.Switch, {
    checked: enableWhiteLabelStatus,
    onChange: updateLoadFontsLocallyStatus,
    className: classNames(enableWhiteLabelStatus ? 'bg-astra' : 'bg-slate-200', 'group relative inline-flex h-4 w-9 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-astra focus:ring-offset-2')
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    "aria-hidden": "true",
    className: "pointer-events-none absolute h-full w-full rounded-md bg-white"
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    "aria-hidden": "true",
    className: classNames(enableWhiteLabelStatus ? 'bg-astra' : 'bg-gray-200', 'pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out')
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    "aria-hidden": "true",
    className: classNames(enableWhiteLabelStatus ? 'translate-x-5' : 'translate-x-0', 'toggle-bubble pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-gray-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out')
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "mt-2 w-9/12 text-sm text-slate-500 tablet:w-full"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('White Label removes any links to Astra website and change the identity in the dashboard. This setting is mostly used by agencies and developers who are building websites for clients.', 'astra-addon'))), showSettingsNotification && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_SettingsSavedNotification__WEBPACK_IMPORTED_MODULE_4__["default"], null));
};
/* harmony default export */ __webpack_exports__["default"] = (WhiteLabel);

/***/ }),

/***/ "./assets/src/dashboard-app/pages/settings/WhiteLabelForm.js":
/*!*******************************************************************!*\
  !*** ./assets/src/dashboard-app/pages/settings/WhiteLabelForm.js ***!
  \*******************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _AddonDashboardApp_SettingsSavedNotification__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @AddonDashboardApp/SettingsSavedNotification */ "./assets/src/dashboard-app/SettingsSavedNotification.js");





const WhiteLabelForm = () => {
  const [showSettingsNotification, setShowSettingsNotification] = (0,react__WEBPACK_IMPORTED_MODULE_3__.useState)(false);
  const [savingWhiteLabelDataState, setSavingWhiteLabelDataState] = (0,react__WEBPACK_IMPORTED_MODULE_3__.useState)(false);
  const [whiteLabelFormFields, updateWhiteLabelFormFields] = (0,react__WEBPACK_IMPORTED_MODULE_3__.useState)({
    agencyAuthorName: astra_addon_admin.agency_author_name,
    agencyLicenseLink: astra_addon_admin.agency_license_link,
    agencyAuthorURL: astra_addon_admin.agency_author_url,
    themeName: astra_addon_admin.theme_name,
    themeDescription: astra_addon_admin.theme_description,
    themeScreenshotURL: astra_addon_admin.theme_screenshot_url,
    themeIconURL: astra_addon_admin.theme_icon_url,
    pluginName: astra_addon_admin.plugin_name,
    pluginDescription: astra_addon_admin.plugin_description,
    sTPluginName: astra_addon_admin.st_plugin_name,
    sTPluginDescription: astra_addon_admin.st_plugin_description
  });
  const updateWhiteLabelForm = e => {
    let value = e.target.value,
      key = e.target.dataset.key,
      restkey = e.target.dataset.restkey;
    let clonnedFormFieldState = {
      ...whiteLabelFormFields
    };
    clonnedFormFieldState[key] = value;
    updateWhiteLabelFormFields(clonnedFormFieldState);
    window.astra_addon_admin[restkey] = value;
  };
  const submitWhiteLabelData = () => {
    setSavingWhiteLabelDataState('loading');
    const formData = new window.FormData();
    formData.append('action', 'astra_addon_update_whitelabel');
    formData.append('security', astra_addon_admin.update_nonce);
    formData.append('data', JSON.stringify(whiteLabelFormFields));
    _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2___default()({
      url: astra_admin.ajax_url,
      method: 'POST',
      body: formData
    }).then(response => {
      if (response.success) {
        setSavingWhiteLabelDataState(false);
        setShowSettingsNotification(true);
        setTimeout(() => {
          setShowSettingsNotification(false);
          let newThemeName = response.data.rebranded_theme_name,
            pureName = newThemeName.replaceAll('%', '');
          window.open(`${astra_admin.admin_url}?page=${pureName.toLowerCase()}&path=settings`, '_self');
        }, 500);
      }
    });
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("section", {
    className: "ast-whitelabel-wrap"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "block px-8 py-8 justify-between"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "w-full "
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    className: "p-0 text-base leading-6 font-semibold text-slate-800 mb-8"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Agency Details", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mb-6"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "author",
    className: "block text-sm font-medium text-slate-600"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Agency author name", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mt-2"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    onChange: updateWhiteLabelForm,
    value: whiteLabelFormFields.agencyAuthorName,
    "data-parent": "astra-agency",
    "data-key": "agencyAuthorName",
    "data-restkey": "agency_author_name",
    type: "text",
    name: "author",
    id: "author",
    className: "ast-admin_input-field h-10 block w-4/5 shadow-sm focus:border-astra focus:ring-astra sm:text-sm",
    placeholder: ""
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mb-6"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "author_url",
    className: "block text-sm font-medium text-slate-600"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Agency author URL", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mt-2"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    onChange: updateWhiteLabelForm,
    type: "text",
    value: whiteLabelFormFields.agencyAuthorURL,
    "data-parent": "astra-agency",
    "data-key": "agencyAuthorURL",
    "data-restkey": "agency_author_url",
    name: "author_url",
    id: "author_url",
    className: "ast-admin_input-field h-10 block w-4/5 shadow-sm focus:border-astra focus:ring-astra sm:text-sm",
    placeholder: ""
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: ""
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "licence",
    className: "block text-sm font-medium text-slate-600"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Agency license link", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mt-2"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    onChange: updateWhiteLabelForm,
    type: "text",
    value: whiteLabelFormFields.agencyLicenseLink,
    "data-parent": "astra-agency",
    "data-key": "agencyLicenseLink",
    "data-restkey": "agency_license_link",
    name: "licence",
    id: "licence",
    className: "ast-admin_input-field h-10 block w-4/5 shadow-sm focus:border-astra focus:ring-astra sm:text-sm",
    placeholder: ""
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "mt-2 text-sm text-slate-500"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Get license link will be displayed in the license form when the purchase key is expired/not valid.", "astra-addon"))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "block border-t border-solid border-slate-200 px-8 py-8 justify-between"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "w-full"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    className: "p-0 text-base leading-6 font-semibold text-slate-800 mb-8"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Astra Theme Branding", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mb-6"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "name",
    className: "block text-sm font-medium text-slate-600"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Theme Name", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mt-2"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    onChange: updateWhiteLabelForm,
    type: "text",
    value: whiteLabelFormFields.themeName,
    "data-parent": "astra",
    "data-key": "themeName",
    "data-restkey": "theme_name",
    name: "name",
    id: "name",
    className: "ast-admin_input-field h-10 block w-4/5 shadow-sm focus:border-astra focus:ring-astra sm:text-sm",
    placeholder: ""
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mb-6"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "description",
    className: "block text-sm font-medium text-slate-600"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Theme Description", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mt-2"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    name: "description",
    id: "description",
    "data-parent": "astra",
    "data-key": "themeDescription",
    "data-restkey": "theme_description",
    onChange: updateWhiteLabelForm,
    value: whiteLabelFormFields.themeDescription,
    rows: "4",
    className: "ast-admin_input-field block w-4/5 shadow-sm focus:border-astra focus:ring-astra sm:text-sm"
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mb-6"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "screenshot",
    className: "block text-sm font-medium text-slate-600"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Theme Screenshot URL", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mt-2"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    onChange: updateWhiteLabelForm,
    "data-parent": "astra",
    "data-key": "themeScreenshotURL",
    "data-restkey": "theme_screenshot_url",
    type: "text",
    value: whiteLabelFormFields.themeScreenshotURL,
    name: "screenshot",
    id: "screenshot",
    className: "ast-admin_input-field h-10 block w-4/5 shadow-sm focus:border-astra focus:ring-astra sm:text-sm",
    placeholder: ""
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "mt-2 text-sm text-slate-500"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("The recommended image size is 1200px wide by 900px tall.", "astra-addon"))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: ""
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "icon",
    className: "block text-sm font-medium text-slate-600"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Theme Icon URL", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mt-2"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    onChange: updateWhiteLabelForm,
    "data-parent": "astra",
    "data-key": "themeIconURL",
    "data-restkey": "theme_icon_url",
    type: "text",
    value: whiteLabelFormFields.themeIconURL,
    name: "icon",
    id: "icon",
    className: "ast-admin_input-field h-10 block w-4/5 shadow-sm focus:border-astra focus:ring-astra sm:text-sm",
    placeholder: ""
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "mt-2 text-sm text-slate-500"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("The recommended icon should have some background to get adjust properly on white background too.", "astra-addon"))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "block border-t border-solid border-slate-200 px-8 py-8 justify-between"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "w-full "
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    className: "p-0 text-base leading-6 font-semibold text-slate-800 mb-8"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Astra Pro Branding", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mb-6"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "astra_pro_name",
    className: "block text-sm font-medium text-slate-600"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Plugin Name", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mt-2"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    onChange: updateWhiteLabelForm,
    type: "text",
    "data-parent": "astra-pro",
    "data-key": "pluginName",
    "data-restkey": "plugin_name",
    value: whiteLabelFormFields.pluginName,
    name: "astra_pro_name",
    id: "astra_pro_name",
    className: "ast-admin_input-field h-10 block w-4/5 shadow-sm focus:border-astra focus:ring-astra sm:text-sm",
    placeholder: ""
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: ""
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "astra_pro_description",
    className: "block text-sm font-medium text-slate-600"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Plugin Description", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mt-2"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    name: "astra_pro_description",
    id: "astra_pro_description",
    "data-parent": "astra-pro",
    "data-key": "pluginDescription",
    "data-restkey": "plugin_description",
    onChange: updateWhiteLabelForm,
    value: whiteLabelFormFields.pluginDescription,
    rows: "4",
    className: "ast-admin_input-field block w-4/5 shadow-sm focus:border-astra focus:ring-astra sm:text-sm"
  }))))), astra_admin.starter_templates_data.is_available && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "block border-t border-solid border-slate-200 px-8 py-8 justify-between"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "w-full "
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    className: "p-0 text-base leading-6 font-semibold text-slate-800 mb-8"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Starter Templates Branding", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mb-6"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "st_name",
    className: "block text-sm font-medium text-slate-600"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Plugin Name", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mt-2"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    onChange: updateWhiteLabelForm,
    type: "text",
    "data-parent": "astra-sites",
    "data-key": "sTPluginName",
    "data-restkey": "st_plugin_name",
    value: whiteLabelFormFields.sTPluginName,
    name: "st_name",
    id: "st_name",
    className: "ast-admin_input-field h-10 block w-4/5 shadow-sm focus:border-astra focus:ring-astra sm:text-sm",
    placeholder: ""
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: ""
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "st_description",
    className: "block text-sm font-medium text-slate-600"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Plugin Description", "astra-addon")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mt-2"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    name: "st_description",
    id: "st_description",
    "data-parent": "astra-sites",
    "data-key": "sTPluginDescription",
    "data-restkey": "st_plugin_description",
    onChange: updateWhiteLabelForm,
    value: whiteLabelFormFields.sTPluginDescription,
    rows: "4",
    className: "ast-admin_input-field block w-4/5 shadow-sm focus:border-astra focus:ring-astra sm:text-sm"
  }))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "block mb-8 w-4/5 px-8"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    onClick: submitWhiteLabelData,
    className: "inline-flex ml-auto px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-astra focus-visible:bg-astra-hover hover:bg-astra-hover focus:outline-none"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Save", "astra-addon"), 'loading' === savingWhiteLabelDataState && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    className: "animate-spin -mr-1 ml-3 h-5 w-5 text-white",
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 24 24"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("circle", {
    className: "opacity-25",
    cx: "12",
    cy: "12",
    r: "10",
    stroke: "currentColor",
    strokeWidth: "4"
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    className: "opacity-75",
    fill: "currentColor",
    d: "M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
  }))))), showSettingsNotification && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_SettingsSavedNotification__WEBPACK_IMPORTED_MODULE_4__["default"], null));
};
/* harmony default export */ __webpack_exports__["default"] = (WhiteLabelForm);

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ (function(module) {

module.exports = window["React"];

/***/ }),

/***/ "react-dom":
/*!***************************!*\
  !*** external "ReactDOM" ***!
  \***************************/
/***/ (function(module) {

module.exports = window["ReactDOM"];

/***/ }),

/***/ "@wordpress/api-fetch":
/*!**********************************!*\
  !*** external ["wp","apiFetch"] ***!
  \**********************************/
/***/ (function(module) {

module.exports = window["wp"]["apiFetch"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ (function(module) {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ (function(module) {

module.exports = window["wp"]["i18n"];

/***/ }),

/***/ "./node_modules/@headlessui/react/dist/components/description/description.js":
/*!***********************************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/components/description/description.js ***!
  \***********************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Description": function() { return /* binding */ F; },
/* harmony export */   "useDescriptions": function() { return /* binding */ k; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _hooks_use_id_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../hooks/use-id.js */ "./node_modules/@headlessui/react/dist/hooks/use-id.js");
/* harmony import */ var _utils_render_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../utils/render.js */ "./node_modules/@headlessui/react/dist/utils/render.js");
/* harmony import */ var _hooks_use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../hooks/use-iso-morphic-effect.js */ "./node_modules/@headlessui/react/dist/hooks/use-iso-morphic-effect.js");
/* harmony import */ var _hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../hooks/use-sync-refs.js */ "./node_modules/@headlessui/react/dist/hooks/use-sync-refs.js");
/* harmony import */ var _hooks_use_event_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../hooks/use-event.js */ "./node_modules/@headlessui/react/dist/hooks/use-event.js");
let d=(0,react__WEBPACK_IMPORTED_MODULE_0__.createContext)(null);function u(){let r=(0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(d);if(r===null){let t=new Error("You used a <Description /> component, but it is not inside a relevant parent.");throw Error.captureStackTrace&&Error.captureStackTrace(t,u),t}return r}function k(){let[r,t]=(0,react__WEBPACK_IMPORTED_MODULE_0__.useState)([]);return[r.length>0?r.join(" "):void 0,(0,react__WEBPACK_IMPORTED_MODULE_0__.useMemo)(()=>function(e){let i=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_1__.useEvent)(n=>(t(o=>[...o,n]),()=>t(o=>{let c=o.slice(),p=c.indexOf(n);return p!==-1&&c.splice(p,1),c}))),s=(0,react__WEBPACK_IMPORTED_MODULE_0__.useMemo)(()=>({register:i,slot:e.slot,name:e.name,props:e.props}),[i,e.slot,e.name,e.props]);return react__WEBPACK_IMPORTED_MODULE_0__.createElement(d.Provider,{value:s},e.children)},[t])]}let S="p",F=(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_2__.forwardRefWithAs)(function(t,a){let e=u(),i=`headlessui-description-${(0,_hooks_use_id_js__WEBPACK_IMPORTED_MODULE_3__.useId)()}`,s=(0,_hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_4__.useSyncRefs)(a);(0,_hooks_use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_5__.useIsoMorphicEffect)(()=>e.register(i),[i,e.register]);let n=t,o={ref:s,...e.props,id:i};return (0,_utils_render_js__WEBPACK_IMPORTED_MODULE_2__.render)({ourProps:o,theirProps:n,slot:e.slot||{},defaultTag:S,name:e.name||"Description"})});


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/components/dialog/dialog.js":
/*!*************************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/components/dialog/dialog.js ***!
  \*************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Dialog": function() { return /* binding */ gt; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _utils_match_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../utils/match.js */ "./node_modules/@headlessui/react/dist/utils/match.js");
/* harmony import */ var _utils_render_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../utils/render.js */ "./node_modules/@headlessui/react/dist/utils/render.js");
/* harmony import */ var _hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../hooks/use-sync-refs.js */ "./node_modules/@headlessui/react/dist/hooks/use-sync-refs.js");
/* harmony import */ var _keyboard_js__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ../keyboard.js */ "./node_modules/@headlessui/react/dist/components/keyboard.js");
/* harmony import */ var _utils_bugs_js__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(/*! ../../utils/bugs.js */ "./node_modules/@headlessui/react/dist/utils/bugs.js");
/* harmony import */ var _hooks_use_id_js__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ../../hooks/use-id.js */ "./node_modules/@headlessui/react/dist/hooks/use-id.js");
/* harmony import */ var _components_focus_trap_focus_trap_js__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! ../../components/focus-trap/focus-trap.js */ "./node_modules/@headlessui/react/dist/components/focus-trap/focus-trap.js");
/* harmony import */ var _hooks_use_inert_others_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ../../hooks/use-inert-others.js */ "./node_modules/@headlessui/react/dist/hooks/use-inert-others.js");
/* harmony import */ var _components_portal_portal_js__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! ../../components/portal/portal.js */ "./node_modules/@headlessui/react/dist/components/portal/portal.js");
/* harmony import */ var _internal_portal_force_root_js__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! ../../internal/portal-force-root.js */ "./node_modules/@headlessui/react/dist/internal/portal-force-root.js");
/* harmony import */ var _description_description_js__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ../description/description.js */ "./node_modules/@headlessui/react/dist/components/description/description.js");
/* harmony import */ var _internal_open_closed_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../internal/open-closed.js */ "./node_modules/@headlessui/react/dist/internal/open-closed.js");
/* harmony import */ var _hooks_use_server_handoff_complete_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../../hooks/use-server-handoff-complete.js */ "./node_modules/@headlessui/react/dist/hooks/use-server-handoff-complete.js");
/* harmony import */ var _internal_stack_context_js__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ../../internal/stack-context.js */ "./node_modules/@headlessui/react/dist/internal/stack-context.js");
/* harmony import */ var _hooks_use_outside_click_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ../../hooks/use-outside-click.js */ "./node_modules/@headlessui/react/dist/hooks/use-outside-click.js");
/* harmony import */ var _hooks_use_owner_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../hooks/use-owner.js */ "./node_modules/@headlessui/react/dist/hooks/use-owner.js");
/* harmony import */ var _hooks_use_event_listener_js__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ../../hooks/use-event-listener.js */ "./node_modules/@headlessui/react/dist/hooks/use-event-listener.js");
/* harmony import */ var _internal_hidden_js__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! ../../internal/hidden.js */ "./node_modules/@headlessui/react/dist/internal/hidden.js");
/* harmony import */ var _hooks_use_event_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../hooks/use-event.js */ "./node_modules/@headlessui/react/dist/hooks/use-event.js");
/* harmony import */ var _utils_disposables_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../utils/disposables.js */ "./node_modules/@headlessui/react/dist/utils/disposables.js");
/* harmony import */ var _utils_platform_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../utils/platform.js */ "./node_modules/@headlessui/react/dist/utils/platform.js");
var Re=(r=>(r[r.Open=0]="Open",r[r.Closed=1]="Closed",r))(Re||{}),be=(e=>(e[e.SetTitleId=0]="SetTitleId",e))(be||{});let Ae={[0](l,e){return l.titleId===e.id?l:{...l,titleId:e.id}}},M=(0,react__WEBPACK_IMPORTED_MODULE_0__.createContext)(null);M.displayName="DialogContext";function L(l){let e=(0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(M);if(e===null){let r=new Error(`<${l} /> is missing a parent <Dialog /> component.`);throw Error.captureStackTrace&&Error.captureStackTrace(r,L),r}return e}function Ee(l,e){(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{var p;if(!e||!l)return;let r=(0,_utils_disposables_js__WEBPACK_IMPORTED_MODULE_1__.disposables)();function t(n,d,m){let i=n.style.getPropertyValue(d);return Object.assign(n.style,{[d]:m}),r.add(()=>{Object.assign(n.style,{[d]:i})})}let o=l.documentElement,s=((p=l.defaultView)!=null?p:window).innerWidth-o.clientWidth;if(t(o,"overflow","hidden"),s>0){let n=o.clientWidth-o.offsetWidth,d=s-n;t(o,"paddingRight",`${d}px`)}if((0,_utils_platform_js__WEBPACK_IMPORTED_MODULE_2__.isIOS)()){let n=window.pageYOffset;t(o,"position","fixed"),t(o,"marginTop",`-${n}px`),t(o,"width","100%"),r.add(()=>window.scrollTo(0,n))}return r.dispose},[l,e])}function ve(l,e){return (0,_utils_match_js__WEBPACK_IMPORTED_MODULE_3__.match)(e.type,Ae,l,e)}let Oe="div",Ce=_utils_render_js__WEBPACK_IMPORTED_MODULE_4__.Features.RenderStrategy|_utils_render_js__WEBPACK_IMPORTED_MODULE_4__.Features.Static,Se=(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_4__.forwardRefWithAs)(function(e,r){let{open:t,onClose:o,initialFocus:a,__demoMode:s=!1,...p}=e,[n,d]=(0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(0),m=(0,_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_5__.useOpenClosed)();t===void 0&&m!==null&&(t=(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_3__.match)(m,{[_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_5__.State.Open]:!0,[_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_5__.State.Closed]:!1}));let i=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(new Set),T=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null),K=(0,_hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_6__.useSyncRefs)(T,r),W=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null),P=(0,_hooks_use_owner_js__WEBPACK_IMPORTED_MODULE_7__.useOwnerDocument)(T),B=e.hasOwnProperty("open")||m!==null,G=e.hasOwnProperty("onClose");if(!B&&!G)throw new Error("You have to provide an `open` and an `onClose` prop to the `Dialog` component.");if(!B)throw new Error("You provided an `onClose` prop to the `Dialog`, but forgot an `open` prop.");if(!G)throw new Error("You provided an `open` prop to the `Dialog`, but forgot an `onClose` prop.");if(typeof t!="boolean")throw new Error(`You provided an \`open\` prop to the \`Dialog\`, but the value is not a boolean. Received: ${t}`);if(typeof o!="function")throw new Error(`You provided an \`onClose\` prop to the \`Dialog\`, but the value is not a function. Received: ${o}`);let u=t?0:1,[y,q]=(0,react__WEBPACK_IMPORTED_MODULE_0__.useReducer)(ve,{titleId:null,descriptionId:null,panelRef:(0,react__WEBPACK_IMPORTED_MODULE_0__.createRef)()}),h=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_8__.useEvent)(()=>o(!1)),U=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_8__.useEvent)(f=>q({type:0,id:f})),_=(0,_hooks_use_server_handoff_complete_js__WEBPACK_IMPORTED_MODULE_9__.useServerHandoffComplete)()?s?!1:u===0:!1,w=n>1,z=(0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(M)!==null,J=w?"parent":"leaf";(0,_hooks_use_inert_others_js__WEBPACK_IMPORTED_MODULE_10__.useInertOthers)(T,w?_:!1),(0,_hooks_use_outside_click_js__WEBPACK_IMPORTED_MODULE_11__.useOutsideClick)(()=>{var R,g;return[...Array.from((R=P==null?void 0:P.querySelectorAll("body > *, [data-headlessui-portal]"))!=null?R:[]).filter(D=>!(!(D instanceof HTMLElement)||D.contains(W.current)||y.panelRef.current&&D.contains(y.panelRef.current))),(g=y.panelRef.current)!=null?g:T.current]},h,_&&!w),(0,_hooks_use_event_listener_js__WEBPACK_IMPORTED_MODULE_12__.useEventListener)(P==null?void 0:P.defaultView,"keydown",f=>{f.defaultPrevented||f.key===_keyboard_js__WEBPACK_IMPORTED_MODULE_13__.Keys.Escape&&u===0&&(w||(f.preventDefault(),f.stopPropagation(),h()))}),Ee(P,u===0&&!z),(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{if(u!==0||!T.current)return;let f=new IntersectionObserver(R=>{for(let g of R)g.boundingClientRect.x===0&&g.boundingClientRect.y===0&&g.boundingClientRect.width===0&&g.boundingClientRect.height===0&&h()});return f.observe(T.current),()=>f.disconnect()},[u,T,h]);let[Q,X]=(0,_description_description_js__WEBPACK_IMPORTED_MODULE_14__.useDescriptions)(),Z=`headlessui-dialog-${(0,_hooks_use_id_js__WEBPACK_IMPORTED_MODULE_15__.useId)()}`,ee=(0,react__WEBPACK_IMPORTED_MODULE_0__.useMemo)(()=>[{dialogState:u,close:h,setTitleId:U},y],[u,y,h,U]),$=(0,react__WEBPACK_IMPORTED_MODULE_0__.useMemo)(()=>({open:u===0}),[u]),te={ref:K,id:Z,role:"dialog","aria-modal":u===0?!0:void 0,"aria-labelledby":y.titleId,"aria-describedby":Q};return react__WEBPACK_IMPORTED_MODULE_0__.createElement(_internal_stack_context_js__WEBPACK_IMPORTED_MODULE_16__.StackProvider,{type:"Dialog",enabled:u===0,element:T,onUpdate:(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_8__.useEvent)((f,R,g)=>{R==="Dialog"&&(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_3__.match)(f,{[_internal_stack_context_js__WEBPACK_IMPORTED_MODULE_16__.StackMessage.Add](){i.current.add(g),d(D=>D+1)},[_internal_stack_context_js__WEBPACK_IMPORTED_MODULE_16__.StackMessage.Remove](){i.current.add(g),d(D=>D-1)}})})},react__WEBPACK_IMPORTED_MODULE_0__.createElement(_internal_portal_force_root_js__WEBPACK_IMPORTED_MODULE_17__.ForcePortalRoot,{force:!0},react__WEBPACK_IMPORTED_MODULE_0__.createElement(_components_portal_portal_js__WEBPACK_IMPORTED_MODULE_18__.Portal,null,react__WEBPACK_IMPORTED_MODULE_0__.createElement(M.Provider,{value:ee},react__WEBPACK_IMPORTED_MODULE_0__.createElement(_components_portal_portal_js__WEBPACK_IMPORTED_MODULE_18__.Portal.Group,{target:T},react__WEBPACK_IMPORTED_MODULE_0__.createElement(_internal_portal_force_root_js__WEBPACK_IMPORTED_MODULE_17__.ForcePortalRoot,{force:!1},react__WEBPACK_IMPORTED_MODULE_0__.createElement(X,{slot:$,name:"Dialog.Description"},react__WEBPACK_IMPORTED_MODULE_0__.createElement(_components_focus_trap_focus_trap_js__WEBPACK_IMPORTED_MODULE_19__.FocusTrap,{initialFocus:a,containers:i,features:_?(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_3__.match)(J,{parent:_components_focus_trap_focus_trap_js__WEBPACK_IMPORTED_MODULE_19__.FocusTrap.features.RestoreFocus,leaf:_components_focus_trap_focus_trap_js__WEBPACK_IMPORTED_MODULE_19__.FocusTrap.features.All&~_components_focus_trap_focus_trap_js__WEBPACK_IMPORTED_MODULE_19__.FocusTrap.features.FocusLock}):_components_focus_trap_focus_trap_js__WEBPACK_IMPORTED_MODULE_19__.FocusTrap.features.None},(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_4__.render)({ourProps:te,theirProps:p,slot:$,defaultTag:Oe,features:Ce,visible:u===0,name:"Dialog"})))))))),react__WEBPACK_IMPORTED_MODULE_0__.createElement(_internal_hidden_js__WEBPACK_IMPORTED_MODULE_20__.Hidden,{features:_internal_hidden_js__WEBPACK_IMPORTED_MODULE_20__.Features.Hidden,ref:W}))}),Le="div",we=(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_4__.forwardRefWithAs)(function(e,r){let[{dialogState:t,close:o}]=L("Dialog.Overlay"),a=(0,_hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_6__.useSyncRefs)(r),s=`headlessui-dialog-overlay-${(0,_hooks_use_id_js__WEBPACK_IMPORTED_MODULE_15__.useId)()}`,p=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_8__.useEvent)(i=>{if(i.target===i.currentTarget){if((0,_utils_bugs_js__WEBPACK_IMPORTED_MODULE_21__.isDisabledReactIssue7711)(i.currentTarget))return i.preventDefault();i.preventDefault(),i.stopPropagation(),o()}}),n=(0,react__WEBPACK_IMPORTED_MODULE_0__.useMemo)(()=>({open:t===0}),[t]);return (0,_utils_render_js__WEBPACK_IMPORTED_MODULE_4__.render)({ourProps:{ref:a,id:s,"aria-hidden":!0,onClick:p},theirProps:e,slot:n,defaultTag:Le,name:"Dialog.Overlay"})}),Fe="div",ke=(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_4__.forwardRefWithAs)(function(e,r){let[{dialogState:t},o]=L("Dialog.Backdrop"),a=(0,_hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_6__.useSyncRefs)(r),s=`headlessui-dialog-backdrop-${(0,_hooks_use_id_js__WEBPACK_IMPORTED_MODULE_15__.useId)()}`;(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{if(o.panelRef.current===null)throw new Error("A <Dialog.Backdrop /> component is being used, but a <Dialog.Panel /> component is missing.")},[o.panelRef]);let p=(0,react__WEBPACK_IMPORTED_MODULE_0__.useMemo)(()=>({open:t===0}),[t]);return react__WEBPACK_IMPORTED_MODULE_0__.createElement(_internal_portal_force_root_js__WEBPACK_IMPORTED_MODULE_17__.ForcePortalRoot,{force:!0},react__WEBPACK_IMPORTED_MODULE_0__.createElement(_components_portal_portal_js__WEBPACK_IMPORTED_MODULE_18__.Portal,null,(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_4__.render)({ourProps:{ref:a,id:s,"aria-hidden":!0},theirProps:e,slot:p,defaultTag:Fe,name:"Dialog.Backdrop"})))}),Me="div",_e=(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_4__.forwardRefWithAs)(function(e,r){let[{dialogState:t},o]=L("Dialog.Panel"),a=(0,_hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_6__.useSyncRefs)(r,o.panelRef),s=`headlessui-dialog-panel-${(0,_hooks_use_id_js__WEBPACK_IMPORTED_MODULE_15__.useId)()}`,p=(0,react__WEBPACK_IMPORTED_MODULE_0__.useMemo)(()=>({open:t===0}),[t]),n=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_8__.useEvent)(i=>{i.stopPropagation()});return (0,_utils_render_js__WEBPACK_IMPORTED_MODULE_4__.render)({ourProps:{ref:a,id:s,onClick:n},theirProps:e,slot:p,defaultTag:Me,name:"Dialog.Panel"})}),xe="h2",Ie=(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_4__.forwardRefWithAs)(function(e,r){let[{dialogState:t,setTitleId:o}]=L("Dialog.Title"),a=`headlessui-dialog-title-${(0,_hooks_use_id_js__WEBPACK_IMPORTED_MODULE_15__.useId)()}`,s=(0,_hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_6__.useSyncRefs)(r);(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>(o(a),()=>o(null)),[a,o]);let p=(0,react__WEBPACK_IMPORTED_MODULE_0__.useMemo)(()=>({open:t===0}),[t]);return (0,_utils_render_js__WEBPACK_IMPORTED_MODULE_4__.render)({ourProps:{ref:s,id:a},theirProps:e,slot:p,defaultTag:xe,name:"Dialog.Title"})}),gt=Object.assign(Se,{Backdrop:ke,Panel:_e,Overlay:we,Title:Ie,Description:_description_description_js__WEBPACK_IMPORTED_MODULE_14__.Description});


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/components/focus-trap/focus-trap.js":
/*!*********************************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/components/focus-trap/focus-trap.js ***!
  \*********************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "FocusTrap": function() { return /* binding */ fe; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _utils_render_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../utils/render.js */ "./node_modules/@headlessui/react/dist/utils/render.js");
/* harmony import */ var _hooks_use_server_handoff_complete_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../hooks/use-server-handoff-complete.js */ "./node_modules/@headlessui/react/dist/hooks/use-server-handoff-complete.js");
/* harmony import */ var _hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../hooks/use-sync-refs.js */ "./node_modules/@headlessui/react/dist/hooks/use-sync-refs.js");
/* harmony import */ var _internal_hidden_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../../internal/hidden.js */ "./node_modules/@headlessui/react/dist/internal/hidden.js");
/* harmony import */ var _utils_focus_management_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../utils/focus-management.js */ "./node_modules/@headlessui/react/dist/utils/focus-management.js");
/* harmony import */ var _utils_match_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../utils/match.js */ "./node_modules/@headlessui/react/dist/utils/match.js");
/* harmony import */ var _hooks_use_event_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../hooks/use-event.js */ "./node_modules/@headlessui/react/dist/hooks/use-event.js");
/* harmony import */ var _hooks_use_tab_direction_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../hooks/use-tab-direction.js */ "./node_modules/@headlessui/react/dist/hooks/use-tab-direction.js");
/* harmony import */ var _hooks_use_is_mounted_js__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ../../hooks/use-is-mounted.js */ "./node_modules/@headlessui/react/dist/hooks/use-is-mounted.js");
/* harmony import */ var _hooks_use_owner_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../hooks/use-owner.js */ "./node_modules/@headlessui/react/dist/hooks/use-owner.js");
/* harmony import */ var _hooks_use_event_listener_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ../../hooks/use-event-listener.js */ "./node_modules/@headlessui/react/dist/hooks/use-event-listener.js");
/* harmony import */ var _utils_micro_task_js__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ../../utils/micro-task.js */ "./node_modules/@headlessui/react/dist/utils/micro-task.js");
/* harmony import */ var _hooks_use_watch_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ../../hooks/use-watch.js */ "./node_modules/@headlessui/react/dist/hooks/use-watch.js");
let N="div";var v=(r=>(r[r.None=1]="None",r[r.InitialFocus=2]="InitialFocus",r[r.TabLock=4]="TabLock",r[r.FocusLock=8]="FocusLock",r[r.RestoreFocus=16]="RestoreFocus",r[r.All=30]="All",r))(v||{});let fe=Object.assign((0,_utils_render_js__WEBPACK_IMPORTED_MODULE_1__.forwardRefWithAs)(function(u,e){let l=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null),o=(0,_hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_2__.useSyncRefs)(l,e),{initialFocus:a,containers:r,features:n=30,...c}=u;(0,_hooks_use_server_handoff_complete_js__WEBPACK_IMPORTED_MODULE_3__.useServerHandoffComplete)()||(n=1);let s=(0,_hooks_use_owner_js__WEBPACK_IMPORTED_MODULE_4__.useOwnerDocument)(l);V({ownerDocument:s},Boolean(n&16));let j=x({ownerDocument:s,container:l,initialFocus:a},Boolean(n&2));G({ownerDocument:s,container:l,containers:r,previousActiveElement:j},Boolean(n&8));let k=(0,_hooks_use_tab_direction_js__WEBPACK_IMPORTED_MODULE_5__.useTabDirection)(),p=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_6__.useEvent)(()=>{let T=l.current;!T||(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_7__.match)(k.current,{[_hooks_use_tab_direction_js__WEBPACK_IMPORTED_MODULE_5__.Direction.Forwards]:()=>(0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_8__.focusIn)(T,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_8__.Focus.First),[_hooks_use_tab_direction_js__WEBPACK_IMPORTED_MODULE_5__.Direction.Backwards]:()=>(0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_8__.focusIn)(T,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_8__.Focus.Last)})}),A={ref:o};return react__WEBPACK_IMPORTED_MODULE_0__.createElement(react__WEBPACK_IMPORTED_MODULE_0__.Fragment,null,Boolean(n&4)&&react__WEBPACK_IMPORTED_MODULE_0__.createElement(_internal_hidden_js__WEBPACK_IMPORTED_MODULE_9__.Hidden,{as:"button",type:"button",onFocus:p,features:_internal_hidden_js__WEBPACK_IMPORTED_MODULE_9__.Features.Focusable}),(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_1__.render)({ourProps:A,theirProps:c,defaultTag:N,name:"FocusTrap"}),Boolean(n&4)&&react__WEBPACK_IMPORTED_MODULE_0__.createElement(_internal_hidden_js__WEBPACK_IMPORTED_MODULE_9__.Hidden,{as:"button",type:"button",onFocus:p,features:_internal_hidden_js__WEBPACK_IMPORTED_MODULE_9__.Features.Focusable}))}),{features:v});function V({ownerDocument:t},u){let e=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);(0,_hooks_use_event_listener_js__WEBPACK_IMPORTED_MODULE_10__.useEventListener)(t==null?void 0:t.defaultView,"focusout",o=>{!u||e.current||(e.current=o.target)},!0),(0,_hooks_use_watch_js__WEBPACK_IMPORTED_MODULE_11__.useWatch)(()=>{u||((t==null?void 0:t.activeElement)===(t==null?void 0:t.body)&&(0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_8__.focusElement)(e.current),e.current=null)},[u]);let l=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(!1);(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>(l.current=!1,()=>{l.current=!0,(0,_utils_micro_task_js__WEBPACK_IMPORTED_MODULE_12__.microTask)(()=>{!l.current||((0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_8__.focusElement)(e.current),e.current=null)})}),[])}function x({ownerDocument:t,container:u,initialFocus:e},l){let o=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null),a=(0,_hooks_use_is_mounted_js__WEBPACK_IMPORTED_MODULE_13__.useIsMounted)();return (0,_hooks_use_watch_js__WEBPACK_IMPORTED_MODULE_11__.useWatch)(()=>{if(!l)return;let r=u.current;!r||(0,_utils_micro_task_js__WEBPACK_IMPORTED_MODULE_12__.microTask)(()=>{if(!a.current)return;let n=t==null?void 0:t.activeElement;if(e!=null&&e.current){if((e==null?void 0:e.current)===n){o.current=n;return}}else if(r.contains(n)){o.current=n;return}e!=null&&e.current?(0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_8__.focusElement)(e.current):(0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_8__.focusIn)(r,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_8__.Focus.First)===_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_8__.FocusResult.Error&&console.warn("There are no focusable elements inside the <FocusTrap />"),o.current=t==null?void 0:t.activeElement})},[l]),o}function G({ownerDocument:t,container:u,containers:e,previousActiveElement:l},o){let a=(0,_hooks_use_is_mounted_js__WEBPACK_IMPORTED_MODULE_13__.useIsMounted)();(0,_hooks_use_event_listener_js__WEBPACK_IMPORTED_MODULE_10__.useEventListener)(t==null?void 0:t.defaultView,"focus",r=>{if(!o||!a.current)return;let n=new Set(e==null?void 0:e.current);n.add(u);let c=l.current;if(!c)return;let s=r.target;s&&s instanceof HTMLElement?W(n,s)?(l.current=s,(0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_8__.focusElement)(s)):(r.preventDefault(),r.stopPropagation(),(0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_8__.focusElement)(c)):(0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_8__.focusElement)(l.current)},!0)}function W(t,u){var e;for(let l of t)if((e=l.current)!=null&&e.contains(u))return!0;return!1}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/components/keyboard.js":
/*!********************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/components/keyboard.js ***!
  \********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Keys": function() { return /* binding */ o; }
/* harmony export */ });
var o=(r=>(r.Space=" ",r.Enter="Enter",r.Escape="Escape",r.Backspace="Backspace",r.Delete="Delete",r.ArrowLeft="ArrowLeft",r.ArrowUp="ArrowUp",r.ArrowRight="ArrowRight",r.ArrowDown="ArrowDown",r.Home="Home",r.End="End",r.PageUp="PageUp",r.PageDown="PageDown",r.Tab="Tab",r))(o||{});


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/components/label/label.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/components/label/label.js ***!
  \***********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Label": function() { return /* binding */ F; },
/* harmony export */   "useLabels": function() { return /* binding */ M; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _hooks_use_id_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../hooks/use-id.js */ "./node_modules/@headlessui/react/dist/hooks/use-id.js");
/* harmony import */ var _utils_render_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../utils/render.js */ "./node_modules/@headlessui/react/dist/utils/render.js");
/* harmony import */ var _hooks_use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../hooks/use-iso-morphic-effect.js */ "./node_modules/@headlessui/react/dist/hooks/use-iso-morphic-effect.js");
/* harmony import */ var _hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../hooks/use-sync-refs.js */ "./node_modules/@headlessui/react/dist/hooks/use-sync-refs.js");
/* harmony import */ var _hooks_use_event_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../hooks/use-event.js */ "./node_modules/@headlessui/react/dist/hooks/use-event.js");
let u=(0,react__WEBPACK_IMPORTED_MODULE_0__.createContext)(null);function c(){let o=(0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(u);if(o===null){let t=new Error("You used a <Label /> component, but it is not inside a relevant parent.");throw Error.captureStackTrace&&Error.captureStackTrace(t,c),t}return o}function M(){let[o,t]=(0,react__WEBPACK_IMPORTED_MODULE_0__.useState)([]);return[o.length>0?o.join(" "):void 0,(0,react__WEBPACK_IMPORTED_MODULE_0__.useMemo)(()=>function(e){let l=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_1__.useEvent)(a=>(t(i=>[...i,a]),()=>t(i=>{let n=i.slice(),d=n.indexOf(a);return d!==-1&&n.splice(d,1),n}))),r=(0,react__WEBPACK_IMPORTED_MODULE_0__.useMemo)(()=>({register:l,slot:e.slot,name:e.name,props:e.props}),[l,e.slot,e.name,e.props]);return react__WEBPACK_IMPORTED_MODULE_0__.createElement(u.Provider,{value:r},e.children)},[t])]}let h="label",F=(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_2__.forwardRefWithAs)(function(t,s){let{passive:e=!1,...l}=t,r=c(),a=`headlessui-label-${(0,_hooks_use_id_js__WEBPACK_IMPORTED_MODULE_3__.useId)()}`,i=(0,_hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_4__.useSyncRefs)(s);(0,_hooks_use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_5__.useIsoMorphicEffect)(()=>r.register(a),[a,r.register]);let n={ref:i,...r.props,id:a};return e&&("onClick"in n&&delete n.onClick,"onClick"in l&&delete l.onClick),(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_2__.render)({ourProps:n,theirProps:l,slot:r.slot||{},defaultTag:h,name:r.name||"Label"})});


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/components/portal/portal.js":
/*!*************************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/components/portal/portal.js ***!
  \*************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Portal": function() { return /* binding */ $; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-dom */ "react-dom");
/* harmony import */ var _utils_render_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../utils/render.js */ "./node_modules/@headlessui/react/dist/utils/render.js");
/* harmony import */ var _hooks_use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../hooks/use-iso-morphic-effect.js */ "./node_modules/@headlessui/react/dist/hooks/use-iso-morphic-effect.js");
/* harmony import */ var _internal_portal_force_root_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../internal/portal-force-root.js */ "./node_modules/@headlessui/react/dist/internal/portal-force-root.js");
/* harmony import */ var _hooks_use_server_handoff_complete_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../hooks/use-server-handoff-complete.js */ "./node_modules/@headlessui/react/dist/hooks/use-server-handoff-complete.js");
/* harmony import */ var _hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../hooks/use-sync-refs.js */ "./node_modules/@headlessui/react/dist/hooks/use-sync-refs.js");
/* harmony import */ var _hooks_use_owner_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../hooks/use-owner.js */ "./node_modules/@headlessui/react/dist/hooks/use-owner.js");
/* harmony import */ var _utils_micro_task_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../../utils/micro-task.js */ "./node_modules/@headlessui/react/dist/utils/micro-task.js");
/* harmony import */ var _utils_ssr_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../utils/ssr.js */ "./node_modules/@headlessui/react/dist/utils/ssr.js");
function x(i){let u=(0,_internal_portal_force_root_js__WEBPACK_IMPORTED_MODULE_2__.usePortalRoot)(),o=(0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(A),e=(0,_hooks_use_owner_js__WEBPACK_IMPORTED_MODULE_3__.useOwnerDocument)(i),[r,f]=(0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(()=>{if(!u&&o!==null||_utils_ssr_js__WEBPACK_IMPORTED_MODULE_4__.isServer)return null;let n=e==null?void 0:e.getElementById("headlessui-portal-root");if(n)return n;if(e===null)return null;let t=e.createElement("div");return t.setAttribute("id","headlessui-portal-root"),e.body.appendChild(t)});return (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{r!==null&&(e!=null&&e.body.contains(r)||e==null||e.body.appendChild(r))},[r,e]),(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{u||o!==null&&f(o.current)},[o,f,u]),r}let _=react__WEBPACK_IMPORTED_MODULE_0__.Fragment,U=(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.forwardRefWithAs)(function(u,o){let e=u,r=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null),f=(0,_hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_6__.useSyncRefs)((0,_hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_6__.optionalRef)(a=>{r.current=a}),o),n=(0,_hooks_use_owner_js__WEBPACK_IMPORTED_MODULE_3__.useOwnerDocument)(r),t=x(r),[l]=(0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(()=>{var a;return _utils_ssr_js__WEBPACK_IMPORTED_MODULE_4__.isServer?null:(a=n==null?void 0:n.createElement("div"))!=null?a:null}),b=(0,_hooks_use_server_handoff_complete_js__WEBPACK_IMPORTED_MODULE_7__.useServerHandoffComplete)(),p=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(!1);return (0,_hooks_use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_8__.useIsoMorphicEffect)(()=>{if(p.current=!1,!(!t||!l))return t.contains(l)||(l.setAttribute("data-headlessui-portal",""),t.appendChild(l)),()=>{p.current=!0,(0,_utils_micro_task_js__WEBPACK_IMPORTED_MODULE_9__.microTask)(()=>{var a;!p.current||!t||!l||(t.removeChild(l),t.childNodes.length<=0&&((a=t.parentElement)==null||a.removeChild(t)))})}},[t,l]),b?!t||!l?null:(0,react_dom__WEBPACK_IMPORTED_MODULE_1__.createPortal)((0,_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.render)({ourProps:{ref:f},theirProps:e,defaultTag:_,name:"Portal"}),l):null}),j=react__WEBPACK_IMPORTED_MODULE_0__.Fragment,A=(0,react__WEBPACK_IMPORTED_MODULE_0__.createContext)(null),F=(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.forwardRefWithAs)(function(u,o){let{target:e,...r}=u,n={ref:(0,_hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_6__.useSyncRefs)(o)};return react__WEBPACK_IMPORTED_MODULE_0__.createElement(A.Provider,{value:e},(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.render)({ourProps:n,theirProps:r,defaultTag:j,name:"Popover.Group"}))}),$=Object.assign(U,{Group:F});


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/components/switch/switch.js":
/*!*************************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/components/switch/switch.js ***!
  \*************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Switch": function() { return /* binding */ be; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _utils_render_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../utils/render.js */ "./node_modules/@headlessui/react/dist/utils/render.js");
/* harmony import */ var _hooks_use_id_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../hooks/use-id.js */ "./node_modules/@headlessui/react/dist/hooks/use-id.js");
/* harmony import */ var _keyboard_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../keyboard.js */ "./node_modules/@headlessui/react/dist/components/keyboard.js");
/* harmony import */ var _utils_bugs_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../utils/bugs.js */ "./node_modules/@headlessui/react/dist/utils/bugs.js");
/* harmony import */ var _label_label_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../label/label.js */ "./node_modules/@headlessui/react/dist/components/label/label.js");
/* harmony import */ var _description_description_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../description/description.js */ "./node_modules/@headlessui/react/dist/components/description/description.js");
/* harmony import */ var _hooks_use_resolve_button_type_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ../../hooks/use-resolve-button-type.js */ "./node_modules/@headlessui/react/dist/hooks/use-resolve-button-type.js");
/* harmony import */ var _hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../hooks/use-sync-refs.js */ "./node_modules/@headlessui/react/dist/hooks/use-sync-refs.js");
/* harmony import */ var _internal_hidden_js__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ../../internal/hidden.js */ "./node_modules/@headlessui/react/dist/internal/hidden.js");
/* harmony import */ var _utils_form_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ../../utils/form.js */ "./node_modules/@headlessui/react/dist/utils/form.js");
/* harmony import */ var _hooks_use_event_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../hooks/use-event.js */ "./node_modules/@headlessui/react/dist/hooks/use-event.js");
/* harmony import */ var _hooks_use_controllable_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../hooks/use-controllable.js */ "./node_modules/@headlessui/react/dist/hooks/use-controllable.js");
let h=(0,react__WEBPACK_IMPORTED_MODULE_0__.createContext)(null);h.displayName="GroupContext";let z=react__WEBPACK_IMPORTED_MODULE_0__.Fragment;function J(b){let[t,o]=(0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(null),[i,d]=(0,_label_label_js__WEBPACK_IMPORTED_MODULE_1__.useLabels)(),[a,s]=(0,_description_description_js__WEBPACK_IMPORTED_MODULE_2__.useDescriptions)(),u=(0,react__WEBPACK_IMPORTED_MODULE_0__.useMemo)(()=>({switch:t,setSwitch:o,labelledby:i,describedby:a}),[t,o,i,a]),p={},m=b;return react__WEBPACK_IMPORTED_MODULE_0__.createElement(s,{name:"Switch.Description"},react__WEBPACK_IMPORTED_MODULE_0__.createElement(d,{name:"Switch.Label",props:{onClick(){!t||(t.click(),t.focus({preventScroll:!0}))}}},react__WEBPACK_IMPORTED_MODULE_0__.createElement(h.Provider,{value:u},(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_3__.render)({ourProps:p,theirProps:m,defaultTag:z,name:"Switch.Group"}))))}let Q="button",V=(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_3__.forwardRefWithAs)(function(t,o){let{checked:i,defaultChecked:d=!1,onChange:a,name:s,value:u,...p}=t,m=`headlessui-switch-${(0,_hooks_use_id_js__WEBPACK_IMPORTED_MODULE_4__.useId)()}`,r=(0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(h),y=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null),P=(0,_hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_5__.useSyncRefs)(y,o,r===null?null:r.setSwitch),[n,f]=(0,_hooks_use_controllable_js__WEBPACK_IMPORTED_MODULE_6__.useControllable)(i,a,d),T=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_7__.useEvent)(()=>f==null?void 0:f(!n)),v=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_7__.useEvent)(e=>{if((0,_utils_bugs_js__WEBPACK_IMPORTED_MODULE_8__.isDisabledReactIssue7711)(e.currentTarget))return e.preventDefault();e.preventDefault(),T()}),k=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_7__.useEvent)(e=>{e.key===_keyboard_js__WEBPACK_IMPORTED_MODULE_9__.Keys.Space?(e.preventDefault(),T()):e.key===_keyboard_js__WEBPACK_IMPORTED_MODULE_9__.Keys.Enter&&(0,_utils_form_js__WEBPACK_IMPORTED_MODULE_10__.attemptSubmit)(e.currentTarget)}),g=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_7__.useEvent)(e=>e.preventDefault()),C=(0,react__WEBPACK_IMPORTED_MODULE_0__.useMemo)(()=>({checked:n}),[n]),D={id:m,ref:P,role:"switch",type:(0,_hooks_use_resolve_button_type_js__WEBPACK_IMPORTED_MODULE_11__.useResolveButtonType)(t,y),tabIndex:0,"aria-checked":n,"aria-labelledby":r==null?void 0:r.labelledby,"aria-describedby":r==null?void 0:r.describedby,onClick:v,onKeyUp:k,onKeyPress:g};return react__WEBPACK_IMPORTED_MODULE_0__.createElement(react__WEBPACK_IMPORTED_MODULE_0__.Fragment,null,s!=null&&n&&react__WEBPACK_IMPORTED_MODULE_0__.createElement(_internal_hidden_js__WEBPACK_IMPORTED_MODULE_12__.Hidden,{features:_internal_hidden_js__WEBPACK_IMPORTED_MODULE_12__.Features.Hidden,...(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_3__.compact)({as:"input",type:"checkbox",hidden:!0,readOnly:!0,checked:n,name:s,value:u})}),(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_3__.render)({ourProps:D,theirProps:p,slot:C,defaultTag:Q,name:"Switch"}))}),be=Object.assign(V,{Group:J,Label:_label_label_js__WEBPACK_IMPORTED_MODULE_1__.Label,Description:_description_description_js__WEBPACK_IMPORTED_MODULE_2__.Description});


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/components/transitions/transition.js":
/*!**********************************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/components/transitions/transition.js ***!
  \**********************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Transition": function() { return /* binding */ We; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _utils_render_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../utils/render.js */ "./node_modules/@headlessui/react/dist/utils/render.js");
/* harmony import */ var _internal_open_closed_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ../../internal/open-closed.js */ "./node_modules/@headlessui/react/dist/internal/open-closed.js");
/* harmony import */ var _utils_match_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../utils/match.js */ "./node_modules/@headlessui/react/dist/utils/match.js");
/* harmony import */ var _hooks_use_is_mounted_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../hooks/use-is-mounted.js */ "./node_modules/@headlessui/react/dist/hooks/use-is-mounted.js");
/* harmony import */ var _hooks_use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ../../hooks/use-iso-morphic-effect.js */ "./node_modules/@headlessui/react/dist/hooks/use-iso-morphic-effect.js");
/* harmony import */ var _hooks_use_latest_value_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../hooks/use-latest-value.js */ "./node_modules/@headlessui/react/dist/hooks/use-latest-value.js");
/* harmony import */ var _hooks_use_server_handoff_complete_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../hooks/use-server-handoff-complete.js */ "./node_modules/@headlessui/react/dist/hooks/use-server-handoff-complete.js");
/* harmony import */ var _hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../hooks/use-sync-refs.js */ "./node_modules/@headlessui/react/dist/hooks/use-sync-refs.js");
/* harmony import */ var _hooks_use_transition_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../../hooks/use-transition.js */ "./node_modules/@headlessui/react/dist/hooks/use-transition.js");
/* harmony import */ var _hooks_use_event_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../hooks/use-event.js */ "./node_modules/@headlessui/react/dist/hooks/use-event.js");
/* harmony import */ var _hooks_use_disposables_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../hooks/use-disposables.js */ "./node_modules/@headlessui/react/dist/hooks/use-disposables.js");
function x(r=""){return r.split(" ").filter(e=>e.trim().length>1)}let F=(0,react__WEBPACK_IMPORTED_MODULE_0__.createContext)(null);F.displayName="TransitionContext";var ve=(s=>(s.Visible="visible",s.Hidden="hidden",s))(ve||{});function Ce(){let r=(0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(F);if(r===null)throw new Error("A <Transition.Child /> is used but it is missing a parent <Transition /> or <Transition.Root />.");return r}function ge(){let r=(0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(M);if(r===null)throw new Error("A <Transition.Child /> is used but it is missing a parent <Transition /> or <Transition.Root />.");return r}let M=(0,react__WEBPACK_IMPORTED_MODULE_0__.createContext)(null);M.displayName="NestingContext";function I(r){return"children"in r?I(r.children):r.current.filter(({el:e})=>e.current!==null).filter(({state:e})=>e==="visible").length>0}function ee(r,e){let s=(0,_hooks_use_latest_value_js__WEBPACK_IMPORTED_MODULE_1__.useLatestValue)(r),n=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)([]),m=(0,_hooks_use_is_mounted_js__WEBPACK_IMPORTED_MODULE_2__.useIsMounted)(),D=(0,_hooks_use_disposables_js__WEBPACK_IMPORTED_MODULE_3__.useDisposables)(),b=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_4__.useEvent)((l,i=_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.RenderStrategy.Hidden)=>{let t=n.current.findIndex(({el:o})=>o===l);t!==-1&&((0,_utils_match_js__WEBPACK_IMPORTED_MODULE_6__.match)(i,{[_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.RenderStrategy.Unmount](){n.current.splice(t,1)},[_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.RenderStrategy.Hidden](){n.current[t].state="hidden"}}),D.microTask(()=>{var o;!I(n)&&m.current&&((o=s.current)==null||o.call(s))}))}),E=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_4__.useEvent)(l=>{let i=n.current.find(({el:t})=>t===l);return i?i.state!=="visible"&&(i.state="visible"):n.current.push({el:l,state:"visible"}),()=>b(l,_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.RenderStrategy.Unmount)}),S=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)([]),u=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(Promise.resolve()),p=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)({enter:[],leave:[],idle:[]}),d=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_4__.useEvent)((l,i,t)=>{S.current.splice(0),e&&(e.chains.current[i]=e.chains.current[i].filter(([o])=>o!==l)),e==null||e.chains.current[i].push([l,new Promise(o=>{S.current.push(o)})]),e==null||e.chains.current[i].push([l,new Promise(o=>{Promise.all(p.current[i].map(([f,a])=>a)).then(()=>o())})]),i==="enter"?u.current=u.current.then(()=>e==null?void 0:e.wait.current).then(()=>t(i)):t(i)}),h=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_4__.useEvent)((l,i,t)=>{Promise.all(p.current[i].splice(0).map(([o,f])=>f)).then(()=>{var o;(o=S.current.shift())==null||o()}).then(()=>t(i))});return (0,react__WEBPACK_IMPORTED_MODULE_0__.useMemo)(()=>({children:n,register:E,unregister:b,onStart:d,onStop:h,wait:u,chains:p}),[E,b,n,d,h,p,u])}function be(){}let Ee=["beforeEnter","afterEnter","beforeLeave","afterLeave"];function te(r){var s;let e={};for(let n of Ee)e[n]=(s=r[n])!=null?s:be;return e}function Se(r){let e=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(te(r));return (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{e.current=te(r)},[r]),e}let xe="div",ne=_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.Features.RenderStrategy,re=(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.forwardRefWithAs)(function(e,s){let{beforeEnter:n,afterEnter:m,beforeLeave:D,afterLeave:b,enter:E,enterFrom:S,enterTo:u,entered:p,leave:d,leaveFrom:h,leaveTo:l,...i}=e,t=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null),o=(0,_hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_7__.useSyncRefs)(t,s),f=i.unmount?_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.RenderStrategy.Unmount:_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.RenderStrategy.Hidden,{show:a,appear:P,initial:ie}=Ce(),[v,_]=(0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(a?"visible":"hidden"),z=ge(),{register:N,unregister:V}=z,j=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>N(t),[N,t]),(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{if(f===_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.RenderStrategy.Hidden&&!!t.current){if(a&&v!=="visible"){_("visible");return}return (0,_utils_match_js__WEBPACK_IMPORTED_MODULE_6__.match)(v,{["hidden"]:()=>V(t),["visible"]:()=>N(t)})}},[v,t,N,V,a,f]);let oe=(0,_hooks_use_latest_value_js__WEBPACK_IMPORTED_MODULE_1__.useLatestValue)({enter:x(E),enterFrom:x(S),enterTo:x(u),entered:x(p),leave:x(d),leaveFrom:x(h),leaveTo:x(l)}),L=Se({beforeEnter:n,afterEnter:m,beforeLeave:D,afterLeave:b}),U=(0,_hooks_use_server_handoff_complete_js__WEBPACK_IMPORTED_MODULE_8__.useServerHandoffComplete)();(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{if(U&&v==="visible"&&t.current===null)throw new Error("Did you forget to passthrough the `ref` to the actual DOM node?")},[t,v,U]);let k=ie&&!P,se=(()=>!U||k||j.current===a?"idle":a?"enter":"leave")(),le=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_4__.useEvent)(C=>(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_6__.match)(C,{enter:()=>L.current.beforeEnter(),leave:()=>L.current.beforeLeave(),idle:()=>{}})),ae=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_4__.useEvent)(C=>(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_6__.match)(C,{enter:()=>L.current.afterEnter(),leave:()=>L.current.afterLeave(),idle:()=>{}})),w=ee(()=>{_("hidden"),V(t)},z);(0,_hooks_use_transition_js__WEBPACK_IMPORTED_MODULE_9__.useTransition)({container:t,classes:oe,direction:se,onStart:(0,_hooks_use_latest_value_js__WEBPACK_IMPORTED_MODULE_1__.useLatestValue)(C=>{w.onStart(t,C,le)}),onStop:(0,_hooks_use_latest_value_js__WEBPACK_IMPORTED_MODULE_1__.useLatestValue)(C=>{w.onStop(t,C,ae),C==="leave"&&!I(w)&&(_("hidden"),V(t))})}),(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{!k||(f===_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.RenderStrategy.Hidden?j.current=null:j.current=a)},[a,k,v]);let ue=i,de={ref:o};return react__WEBPACK_IMPORTED_MODULE_0__.createElement(M.Provider,{value:w},react__WEBPACK_IMPORTED_MODULE_0__.createElement(_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_10__.OpenClosedProvider,{value:(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_6__.match)(v,{["visible"]:_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_10__.State.Open,["hidden"]:_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_10__.State.Closed})},(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.render)({ourProps:de,theirProps:ue,defaultTag:xe,features:ne,visible:v==="visible",name:"Transition.Child"})))}),q=(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.forwardRefWithAs)(function(e,s){let{show:n,appear:m=!1,unmount:D,...b}=e,E=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null),S=(0,_hooks_use_sync_refs_js__WEBPACK_IMPORTED_MODULE_7__.useSyncRefs)(E,s);(0,_hooks_use_server_handoff_complete_js__WEBPACK_IMPORTED_MODULE_8__.useServerHandoffComplete)();let u=(0,_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_10__.useOpenClosed)();if(n===void 0&&u!==null&&(n=(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_6__.match)(u,{[_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_10__.State.Open]:!0,[_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_10__.State.Closed]:!1})),![!0,!1].includes(n))throw new Error("A <Transition /> is used but it is missing a `show={true | false}` prop.");let[p,d]=(0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(n?"visible":"hidden"),h=ee(()=>{d("hidden")}),[l,i]=(0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(!0),t=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)([n]);(0,_hooks_use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_11__.useIsoMorphicEffect)(()=>{l!==!1&&t.current[t.current.length-1]!==n&&(t.current.push(n),i(!1))},[t,n]);let o=(0,react__WEBPACK_IMPORTED_MODULE_0__.useMemo)(()=>({show:n,appear:m,initial:l}),[n,m,l]);(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{if(n)d("visible");else if(!I(h))d("hidden");else{let a=E.current;if(!a)return;let P=a.getBoundingClientRect();P.x===0&&P.y===0&&P.width===0&&P.height===0&&d("hidden")}},[n,h]);let f={unmount:D};return react__WEBPACK_IMPORTED_MODULE_0__.createElement(M.Provider,{value:h},react__WEBPACK_IMPORTED_MODULE_0__.createElement(F.Provider,{value:o},(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.render)({ourProps:{...f,as:react__WEBPACK_IMPORTED_MODULE_0__.Fragment,children:react__WEBPACK_IMPORTED_MODULE_0__.createElement(re,{ref:S,...f,...b})},theirProps:{},defaultTag:react__WEBPACK_IMPORTED_MODULE_0__.Fragment,features:ne,visible:p==="visible",name:"Transition"})))}),Pe=(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_5__.forwardRefWithAs)(function(e,s){let n=(0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(F)!==null,m=(0,_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_10__.useOpenClosed)()!==null;return react__WEBPACK_IMPORTED_MODULE_0__.createElement(react__WEBPACK_IMPORTED_MODULE_0__.Fragment,null,!n&&m?react__WEBPACK_IMPORTED_MODULE_0__.createElement(q,{ref:s,...e}):react__WEBPACK_IMPORTED_MODULE_0__.createElement(re,{ref:s,...e}))}),We=Object.assign(q,{Child:Pe,Root:q});


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/components/transitions/utils/transition.js":
/*!****************************************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/components/transitions/utils/transition.js ***!
  \****************************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Reason": function() { return /* binding */ T; },
/* harmony export */   "transition": function() { return /* binding */ C; }
/* harmony export */ });
/* harmony import */ var _utils_once_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../utils/once.js */ "./node_modules/@headlessui/react/dist/utils/once.js");
/* harmony import */ var _utils_disposables_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../utils/disposables.js */ "./node_modules/@headlessui/react/dist/utils/disposables.js");
/* harmony import */ var _utils_match_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../utils/match.js */ "./node_modules/@headlessui/react/dist/utils/match.js");
function f(t,...e){t&&e.length>0&&t.classList.add(...e)}function v(t,...e){t&&e.length>0&&t.classList.remove(...e)}var T=(n=>(n.Ended="ended",n.Cancelled="cancelled",n))(T||{});function c(t,e){let n=(0,_utils_disposables_js__WEBPACK_IMPORTED_MODULE_0__.disposables)();if(!t)return n.dispose;let{transitionDuration:d,transitionDelay:o}=getComputedStyle(t),[s,u]=[d,o].map(i=>{let[a=0]=i.split(",").filter(Boolean).map(r=>r.includes("ms")?parseFloat(r):parseFloat(r)*1e3).sort((r,l)=>l-r);return a});if(s+u!==0){let i=[];i.push(n.addEventListener(t,"transitionrun",a=>{a.target===a.currentTarget&&(i.splice(0).forEach(r=>r()),i.push(n.addEventListener(t,"transitionend",r=>{r.target===r.currentTarget&&(e("ended"),i.splice(0).forEach(l=>l()))}),n.addEventListener(t,"transitioncancel",r=>{r.target===r.currentTarget&&(e("cancelled"),i.splice(0).forEach(l=>l()))})))}))}else e("ended");return n.add(()=>e("cancelled")),n.dispose}function C(t,e,n,d){let o=n?"enter":"leave",s=(0,_utils_disposables_js__WEBPACK_IMPORTED_MODULE_0__.disposables)(),u=d!==void 0?(0,_utils_once_js__WEBPACK_IMPORTED_MODULE_1__.once)(d):()=>{};o==="enter"&&(t.removeAttribute("hidden"),t.style.display="");let m=(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_2__.match)(o,{enter:()=>e.enter,leave:()=>e.leave}),i=(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_2__.match)(o,{enter:()=>e.enterTo,leave:()=>e.leaveTo}),a=(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_2__.match)(o,{enter:()=>e.enterFrom,leave:()=>e.leaveFrom});return v(t,...e.enter,...e.enterTo,...e.enterFrom,...e.leave,...e.leaveFrom,...e.leaveTo,...e.entered),f(t,...m,...a),s.nextFrame(()=>{v(t,...a),f(t,...i),c(t,r=>(r==="ended"&&(v(t,...m),f(t,...e.entered)),u(r)))}),s.dispose}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-controllable.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-controllable.js ***!
  \***********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useControllable": function() { return /* binding */ p; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _use_event_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./use-event.js */ "./node_modules/@headlessui/react/dist/hooks/use-event.js");
function p(e,t,u){let[l,s]=(0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(u),i=e!==void 0;return[i?e:l,(0,_use_event_js__WEBPACK_IMPORTED_MODULE_1__.useEvent)(r=>(i||s(r),t==null?void 0:t(r)))]}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-disposables.js":
/*!**********************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-disposables.js ***!
  \**********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useDisposables": function() { return /* binding */ p; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _utils_disposables_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utils/disposables.js */ "./node_modules/@headlessui/react/dist/utils/disposables.js");
function p(){let[e]=(0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(_utils_disposables_js__WEBPACK_IMPORTED_MODULE_1__.disposables);return (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>()=>e.dispose(),[e]),e}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-document-event.js":
/*!*************************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-document-event.js ***!
  \*************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useDocumentEvent": function() { return /* binding */ d; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _use_latest_value_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./use-latest-value.js */ "./node_modules/@headlessui/react/dist/hooks/use-latest-value.js");
function d(e,r,n){let o=(0,_use_latest_value_js__WEBPACK_IMPORTED_MODULE_1__.useLatestValue)(r);(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{function t(u){o.current(u)}return document.addEventListener(e,t,n),()=>document.removeEventListener(e,t,n)},[e,n])}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-event-listener.js":
/*!*************************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-event-listener.js ***!
  \*************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useEventListener": function() { return /* binding */ E; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _use_latest_value_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./use-latest-value.js */ "./node_modules/@headlessui/react/dist/hooks/use-latest-value.js");
function E(n,e,a,t){let i=(0,_use_latest_value_js__WEBPACK_IMPORTED_MODULE_1__.useLatestValue)(a);(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{n=n!=null?n:window;function r(o){i.current(o)}return n.addEventListener(e,r,t),()=>n.removeEventListener(e,r,t)},[n,e,t])}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-event.js":
/*!****************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-event.js ***!
  \****************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useEvent": function() { return /* binding */ o; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _use_latest_value_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./use-latest-value.js */ "./node_modules/@headlessui/react/dist/hooks/use-latest-value.js");
let o=function(t){let e=(0,_use_latest_value_js__WEBPACK_IMPORTED_MODULE_1__.useLatestValue)(t);return react__WEBPACK_IMPORTED_MODULE_0__.useCallback((...r)=>e.current(...r),[e])};


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-id.js":
/*!*************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-id.js ***!
  \*************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useId": function() { return /* binding */ I; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./use-iso-morphic-effect.js */ "./node_modules/@headlessui/react/dist/hooks/use-iso-morphic-effect.js");
/* harmony import */ var _use_server_handoff_complete_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./use-server-handoff-complete.js */ "./node_modules/@headlessui/react/dist/hooks/use-server-handoff-complete.js");
var u;let l=0;function r(){return++l}let I=(u=react__WEBPACK_IMPORTED_MODULE_0__.useId)!=null?u:function(){let n=(0,_use_server_handoff_complete_js__WEBPACK_IMPORTED_MODULE_1__.useServerHandoffComplete)(),[e,o]=react__WEBPACK_IMPORTED_MODULE_0__.useState(n?r:null);return (0,_use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_2__.useIsoMorphicEffect)(()=>{e===null&&o(r())},[e]),e!=null?""+e:void 0};


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-inert-others.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-inert-others.js ***!
  \***********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useInertOthers": function() { return /* binding */ M; }
/* harmony export */ });
/* harmony import */ var _utils_owner_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utils/owner.js */ "./node_modules/@headlessui/react/dist/utils/owner.js");
/* harmony import */ var _use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./use-iso-morphic-effect.js */ "./node_modules/@headlessui/react/dist/hooks/use-iso-morphic-effect.js");
let i=new Set,r=new Map;function u(t){t.setAttribute("aria-hidden","true"),t.inert=!0}function l(t){let n=r.get(t);!n||(n["aria-hidden"]===null?t.removeAttribute("aria-hidden"):t.setAttribute("aria-hidden",n["aria-hidden"]),t.inert=n.inert)}function M(t,n=!0){(0,_use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_0__.useIsoMorphicEffect)(()=>{if(!n||!t.current)return;let o=t.current,a=(0,_utils_owner_js__WEBPACK_IMPORTED_MODULE_1__.getOwnerDocument)(o);if(!!a){i.add(o);for(let e of r.keys())e.contains(o)&&(l(e),r.delete(e));return a.querySelectorAll("body > *").forEach(e=>{if(e instanceof HTMLElement){for(let f of i)if(e.contains(f))return;i.size===1&&(r.set(e,{"aria-hidden":e.getAttribute("aria-hidden"),inert:e.inert}),u(e))}}),()=>{if(i.delete(o),i.size>0)a.querySelectorAll("body > *").forEach(e=>{if(e instanceof HTMLElement&&!r.has(e)){for(let f of i)if(e.contains(f))return;r.set(e,{"aria-hidden":e.getAttribute("aria-hidden"),inert:e.inert}),u(e)}});else for(let e of r.keys())l(e),r.delete(e)}}},[n])}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-is-mounted.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-is-mounted.js ***!
  \*********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useIsMounted": function() { return /* binding */ f; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./use-iso-morphic-effect.js */ "./node_modules/@headlessui/react/dist/hooks/use-iso-morphic-effect.js");
function f(){let e=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(!1);return (0,_use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_1__.useIsoMorphicEffect)(()=>(e.current=!0,()=>{e.current=!1}),[]),e}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-iso-morphic-effect.js":
/*!*****************************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-iso-morphic-effect.js ***!
  \*****************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useIsoMorphicEffect": function() { return /* binding */ s; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _utils_ssr_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utils/ssr.js */ "./node_modules/@headlessui/react/dist/utils/ssr.js");
let s=_utils_ssr_js__WEBPACK_IMPORTED_MODULE_1__.isServer?react__WEBPACK_IMPORTED_MODULE_0__.useEffect:react__WEBPACK_IMPORTED_MODULE_0__.useLayoutEffect;


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-latest-value.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-latest-value.js ***!
  \***********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useLatestValue": function() { return /* binding */ s; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./use-iso-morphic-effect.js */ "./node_modules/@headlessui/react/dist/hooks/use-iso-morphic-effect.js");
function s(e){let r=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(e);return (0,_use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_1__.useIsoMorphicEffect)(()=>{r.current=e},[e]),r}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-outside-click.js":
/*!************************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-outside-click.js ***!
  \************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useOutsideClick": function() { return /* binding */ L; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _utils_focus_management_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utils/focus-management.js */ "./node_modules/@headlessui/react/dist/utils/focus-management.js");
/* harmony import */ var _use_document_event_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./use-document-event.js */ "./node_modules/@headlessui/react/dist/hooks/use-document-event.js");
function L(s,E,a=!0){let i=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(!1);(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{requestAnimationFrame(()=>{i.current=a})},[a]);function f(e,l){if(!i.current||e.defaultPrevented)return;let o=function r(t){return typeof t=="function"?r(t()):Array.isArray(t)||t instanceof Set?t:[t]}(s),n=l(e);if(n!==null&&!!n.ownerDocument.documentElement.contains(n)){for(let r of o){if(r===null)continue;let t=r instanceof HTMLElement?r:r.current;if(t!=null&&t.contains(n))return}return!(0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_1__.isFocusableElement)(n,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_1__.FocusableMode.Loose)&&n.tabIndex!==-1&&e.preventDefault(),E(e,n)}}let u=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);(0,_use_document_event_js__WEBPACK_IMPORTED_MODULE_2__.useDocumentEvent)("mousedown",e=>{var l,o;i.current&&(u.current=((o=(l=e.composedPath)==null?void 0:l.call(e))==null?void 0:o[0])||e.target)},!0),(0,_use_document_event_js__WEBPACK_IMPORTED_MODULE_2__.useDocumentEvent)("click",e=>{!u.current||(f(e,()=>u.current),u.current=null)},!0),(0,_use_document_event_js__WEBPACK_IMPORTED_MODULE_2__.useDocumentEvent)("blur",e=>f(e,()=>window.document.activeElement instanceof HTMLIFrameElement?window.document.activeElement:null),!0)}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-owner.js":
/*!****************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-owner.js ***!
  \****************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useOwnerDocument": function() { return /* binding */ n; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _utils_owner_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utils/owner.js */ "./node_modules/@headlessui/react/dist/utils/owner.js");
function n(...e){return (0,react__WEBPACK_IMPORTED_MODULE_0__.useMemo)(()=>(0,_utils_owner_js__WEBPACK_IMPORTED_MODULE_1__.getOwnerDocument)(...e),[...e])}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-resolve-button-type.js":
/*!******************************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-resolve-button-type.js ***!
  \******************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useResolveButtonType": function() { return /* binding */ s; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./use-iso-morphic-effect.js */ "./node_modules/@headlessui/react/dist/hooks/use-iso-morphic-effect.js");
function i(t){var n;if(t.type)return t.type;let e=(n=t.as)!=null?n:"button";if(typeof e=="string"&&e.toLowerCase()==="button")return"button"}function s(t,e){let[n,u]=(0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(()=>i(t));return (0,_use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_1__.useIsoMorphicEffect)(()=>{u(i(t))},[t.type,t.as]),(0,_use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_1__.useIsoMorphicEffect)(()=>{n||!e.current||e.current instanceof HTMLButtonElement&&!e.current.hasAttribute("type")&&u("button")},[n,e]),n}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-server-handoff-complete.js":
/*!**********************************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-server-handoff-complete.js ***!
  \**********************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useServerHandoffComplete": function() { return /* binding */ a; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
let r={serverHandoffComplete:!1};function a(){let[e,f]=(0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(r.serverHandoffComplete);return (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{e!==!0&&f(!0)},[e]),(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{r.serverHandoffComplete===!1&&(r.serverHandoffComplete=!0)},[]),e}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-sync-refs.js":
/*!********************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-sync-refs.js ***!
  \********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "optionalRef": function() { return /* binding */ T; },
/* harmony export */   "useSyncRefs": function() { return /* binding */ y; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _use_event_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./use-event.js */ "./node_modules/@headlessui/react/dist/hooks/use-event.js");
let u=Symbol();function T(t,n=!0){return Object.assign(t,{[u]:n})}function y(...t){let n=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(t);(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{n.current=t},[t]);let c=(0,_use_event_js__WEBPACK_IMPORTED_MODULE_1__.useEvent)(e=>{for(let o of n.current)o!=null&&(typeof o=="function"?o(e):o.current=e)});return t.every(e=>e==null||(e==null?void 0:e[u]))?void 0:c}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-tab-direction.js":
/*!************************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-tab-direction.js ***!
  \************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Direction": function() { return /* binding */ s; },
/* harmony export */   "useTabDirection": function() { return /* binding */ n; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _use_window_event_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./use-window-event.js */ "./node_modules/@headlessui/react/dist/hooks/use-window-event.js");
var s=(r=>(r[r.Forwards=0]="Forwards",r[r.Backwards=1]="Backwards",r))(s||{});function n(){let e=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(0);return (0,_use_window_event_js__WEBPACK_IMPORTED_MODULE_1__.useWindowEvent)("keydown",o=>{o.key==="Tab"&&(e.current=o.shiftKey?1:0)},!0),e}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-transition.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-transition.js ***!
  \*********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useTransition": function() { return /* binding */ I; }
/* harmony export */ });
/* harmony import */ var _components_transitions_utils_transition_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../components/transitions/utils/transition.js */ "./node_modules/@headlessui/react/dist/components/transitions/utils/transition.js");
/* harmony import */ var _utils_disposables_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../utils/disposables.js */ "./node_modules/@headlessui/react/dist/utils/disposables.js");
/* harmony import */ var _utils_match_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../utils/match.js */ "./node_modules/@headlessui/react/dist/utils/match.js");
/* harmony import */ var _use_disposables_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./use-disposables.js */ "./node_modules/@headlessui/react/dist/hooks/use-disposables.js");
/* harmony import */ var _use_is_mounted_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./use-is-mounted.js */ "./node_modules/@headlessui/react/dist/hooks/use-is-mounted.js");
/* harmony import */ var _use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./use-iso-morphic-effect.js */ "./node_modules/@headlessui/react/dist/hooks/use-iso-morphic-effect.js");
/* harmony import */ var _use_latest_value_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./use-latest-value.js */ "./node_modules/@headlessui/react/dist/hooks/use-latest-value.js");
function I({container:o,direction:t,classes:s,onStart:a,onStop:u}){let c=(0,_use_is_mounted_js__WEBPACK_IMPORTED_MODULE_0__.useIsMounted)(),d=(0,_use_disposables_js__WEBPACK_IMPORTED_MODULE_1__.useDisposables)(),r=(0,_use_latest_value_js__WEBPACK_IMPORTED_MODULE_2__.useLatestValue)(t);(0,_use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_3__.useIsoMorphicEffect)(()=>{let e=(0,_utils_disposables_js__WEBPACK_IMPORTED_MODULE_4__.disposables)();d.add(e.dispose);let n=o.current;if(!!n&&r.current!=="idle"&&!!c.current)return e.dispose(),a.current(r.current),e.add((0,_components_transitions_utils_transition_js__WEBPACK_IMPORTED_MODULE_5__.transition)(n,s.current,r.current==="enter",l=>{e.dispose(),(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_6__.match)(l,{[_components_transitions_utils_transition_js__WEBPACK_IMPORTED_MODULE_5__.Reason.Ended](){u.current(r.current)},[_components_transitions_utils_transition_js__WEBPACK_IMPORTED_MODULE_5__.Reason.Cancelled]:()=>{}})})),e.dispose},[t])}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-watch.js":
/*!****************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-watch.js ***!
  \****************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useWatch": function() { return /* binding */ m; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _use_event_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./use-event.js */ "./node_modules/@headlessui/react/dist/hooks/use-event.js");
function m(u,t){let e=(0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)([]),r=(0,_use_event_js__WEBPACK_IMPORTED_MODULE_1__.useEvent)(u);(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{let o=[...e.current];for(let[n,a]of t.entries())if(e.current[n]!==a){let l=r(t,o);return e.current=t,l}},[r,...t])}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/hooks/use-window-event.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/hooks/use-window-event.js ***!
  \***********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useWindowEvent": function() { return /* binding */ s; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _use_latest_value_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./use-latest-value.js */ "./node_modules/@headlessui/react/dist/hooks/use-latest-value.js");
function s(e,r,n){let o=(0,_use_latest_value_js__WEBPACK_IMPORTED_MODULE_1__.useLatestValue)(r);(0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(()=>{function t(i){o.current(i)}return window.addEventListener(e,t,n),()=>window.removeEventListener(e,t,n)},[e,n])}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/internal/hidden.js":
/*!****************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/internal/hidden.js ***!
  \****************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Features": function() { return /* binding */ s; },
/* harmony export */   "Hidden": function() { return /* binding */ h; }
/* harmony export */ });
/* harmony import */ var _utils_render_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utils/render.js */ "./node_modules/@headlessui/react/dist/utils/render.js");
let a="div";var s=(e=>(e[e.None=1]="None",e[e.Focusable=2]="Focusable",e[e.Hidden=4]="Hidden",e))(s||{});let h=(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_0__.forwardRefWithAs)(function(t,o){let{features:e=1,...r}=t,d={ref:o,"aria-hidden":(e&2)===2?!0:void 0,style:{position:"fixed",top:1,left:1,width:1,height:0,padding:0,margin:-1,overflow:"hidden",clip:"rect(0, 0, 0, 0)",whiteSpace:"nowrap",borderWidth:"0",...(e&4)===4&&(e&2)!==2&&{display:"none"}}};return (0,_utils_render_js__WEBPACK_IMPORTED_MODULE_0__.render)({ourProps:d,theirProps:r,slot:{},defaultTag:a,name:"Hidden"})});


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/internal/open-closed.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/internal/open-closed.js ***!
  \*********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "OpenClosedProvider": function() { return /* binding */ C; },
/* harmony export */   "State": function() { return /* binding */ p; },
/* harmony export */   "useOpenClosed": function() { return /* binding */ s; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
let o=(0,react__WEBPACK_IMPORTED_MODULE_0__.createContext)(null);o.displayName="OpenClosedContext";var p=(e=>(e[e.Open=0]="Open",e[e.Closed=1]="Closed",e))(p||{});function s(){return (0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(o)}function C({value:t,children:n}){return react__WEBPACK_IMPORTED_MODULE_0__.createElement(o.Provider,{value:t},n)}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/internal/portal-force-root.js":
/*!***************************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/internal/portal-force-root.js ***!
  \***************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ForcePortalRoot": function() { return /* binding */ P; },
/* harmony export */   "usePortalRoot": function() { return /* binding */ l; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
let e=(0,react__WEBPACK_IMPORTED_MODULE_0__.createContext)(!1);function l(){return (0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(e)}function P(o){return react__WEBPACK_IMPORTED_MODULE_0__.createElement(e.Provider,{value:o.force},o.children)}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/internal/stack-context.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/internal/stack-context.js ***!
  \***********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "StackMessage": function() { return /* binding */ s; },
/* harmony export */   "StackProvider": function() { return /* binding */ M; },
/* harmony export */   "useStackContext": function() { return /* binding */ x; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _hooks_use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../hooks/use-iso-morphic-effect.js */ "./node_modules/@headlessui/react/dist/hooks/use-iso-morphic-effect.js");
/* harmony import */ var _hooks_use_event_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../hooks/use-event.js */ "./node_modules/@headlessui/react/dist/hooks/use-event.js");
let a=(0,react__WEBPACK_IMPORTED_MODULE_0__.createContext)(()=>{});a.displayName="StackContext";var s=(e=>(e[e.Add=0]="Add",e[e.Remove=1]="Remove",e))(s||{});function x(){return (0,react__WEBPACK_IMPORTED_MODULE_0__.useContext)(a)}function M({children:i,onUpdate:r,type:e,element:n,enabled:u}){let l=x(),o=(0,_hooks_use_event_js__WEBPACK_IMPORTED_MODULE_1__.useEvent)((...t)=>{r==null||r(...t),l(...t)});return (0,_hooks_use_iso_morphic_effect_js__WEBPACK_IMPORTED_MODULE_2__.useIsoMorphicEffect)(()=>{let t=u===void 0||u===!0;return t&&o(0,e,n),()=>{t&&o(1,e,n)}},[o,e,n,u]),react__WEBPACK_IMPORTED_MODULE_0__.createElement(a.Provider,{value:o},i)}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/utils/bugs.js":
/*!***********************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/utils/bugs.js ***!
  \***********************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "isDisabledReactIssue7711": function() { return /* binding */ r; }
/* harmony export */ });
function r(n){let e=n.parentElement,l=null;for(;e&&!(e instanceof HTMLFieldSetElement);)e instanceof HTMLLegendElement&&(l=e),e=e.parentElement;let t=(e==null?void 0:e.getAttribute("disabled"))==="";return t&&i(l)?!1:t}function i(n){if(!n)return!1;let e=n.previousElementSibling;for(;e!==null;){if(e instanceof HTMLLegendElement)return!1;e=e.previousElementSibling}return!0}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/utils/disposables.js":
/*!******************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/utils/disposables.js ***!
  \******************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "disposables": function() { return /* binding */ m; }
/* harmony export */ });
/* harmony import */ var _micro_task_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./micro-task.js */ "./node_modules/@headlessui/react/dist/utils/micro-task.js");
function m(){let n=[],i=[],r={enqueue(e){i.push(e)},addEventListener(e,t,a,o){return e.addEventListener(t,a,o),r.add(()=>e.removeEventListener(t,a,o))},requestAnimationFrame(...e){let t=requestAnimationFrame(...e);return r.add(()=>cancelAnimationFrame(t))},nextFrame(...e){return r.requestAnimationFrame(()=>r.requestAnimationFrame(...e))},setTimeout(...e){let t=setTimeout(...e);return r.add(()=>clearTimeout(t))},microTask(...e){let t={current:!0};return (0,_micro_task_js__WEBPACK_IMPORTED_MODULE_0__.microTask)(()=>{t.current&&e[0]()}),r.add(()=>{t.current=!1})},add(e){return n.push(e),()=>{let t=n.indexOf(e);if(t>=0){let[a]=n.splice(t,1);a()}}},dispose(){for(let e of n.splice(0))e()},async workQueue(){for(let e of i.splice(0))await e()}};return r}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/utils/focus-management.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/utils/focus-management.js ***!
  \***********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Focus": function() { return /* binding */ T; },
/* harmony export */   "FocusResult": function() { return /* binding */ M; },
/* harmony export */   "FocusableMode": function() { return /* binding */ N; },
/* harmony export */   "focusElement": function() { return /* binding */ h; },
/* harmony export */   "focusFrom": function() { return /* binding */ D; },
/* harmony export */   "focusIn": function() { return /* binding */ O; },
/* harmony export */   "getFocusableElements": function() { return /* binding */ d; },
/* harmony export */   "isFocusableElement": function() { return /* binding */ F; },
/* harmony export */   "restoreFocusIfNecessary": function() { return /* binding */ I; },
/* harmony export */   "sortByDomNode": function() { return /* binding */ S; }
/* harmony export */ });
/* harmony import */ var _disposables_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./disposables.js */ "./node_modules/@headlessui/react/dist/utils/disposables.js");
/* harmony import */ var _match_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./match.js */ "./node_modules/@headlessui/react/dist/utils/match.js");
/* harmony import */ var _owner_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./owner.js */ "./node_modules/@headlessui/react/dist/utils/owner.js");
let m=["[contentEditable=true]","[tabindex]","a[href]","area[href]","button:not([disabled])","iframe","input:not([disabled])","select:not([disabled])","textarea:not([disabled])"].map(e=>`${e}:not([tabindex='-1'])`).join(",");var T=(n=>(n[n.First=1]="First",n[n.Previous=2]="Previous",n[n.Next=4]="Next",n[n.Last=8]="Last",n[n.WrapAround=16]="WrapAround",n[n.NoScroll=32]="NoScroll",n))(T||{}),M=(o=>(o[o.Error=0]="Error",o[o.Overflow=1]="Overflow",o[o.Success=2]="Success",o[o.Underflow=3]="Underflow",o))(M||{}),b=(r=>(r[r.Previous=-1]="Previous",r[r.Next=1]="Next",r))(b||{});function d(e=document.body){return e==null?[]:Array.from(e.querySelectorAll(m))}var N=(r=>(r[r.Strict=0]="Strict",r[r.Loose=1]="Loose",r))(N||{});function F(e,t=0){var r;return e===((r=(0,_owner_js__WEBPACK_IMPORTED_MODULE_0__.getOwnerDocument)(e))==null?void 0:r.body)?!1:(0,_match_js__WEBPACK_IMPORTED_MODULE_1__.match)(t,{[0](){return e.matches(m)},[1](){let l=e;for(;l!==null;){if(l.matches(m))return!0;l=l.parentElement}return!1}})}function I(e){let t=(0,_owner_js__WEBPACK_IMPORTED_MODULE_0__.getOwnerDocument)(e);(0,_disposables_js__WEBPACK_IMPORTED_MODULE_2__.disposables)().nextFrame(()=>{t&&!F(t.activeElement,0)&&h(e)})}function h(e){e==null||e.focus({preventScroll:!0})}let w=["textarea","input"].join(",");function H(e){var t,r;return(r=(t=e==null?void 0:e.matches)==null?void 0:t.call(e,w))!=null?r:!1}function S(e,t=r=>r){return e.slice().sort((r,l)=>{let o=t(r),s=t(l);if(o===null||s===null)return 0;let n=o.compareDocumentPosition(s);return n&Node.DOCUMENT_POSITION_FOLLOWING?-1:n&Node.DOCUMENT_POSITION_PRECEDING?1:0})}function D(e,t){return O(d(),t,!0,e)}function O(e,t,r=!0,l=null){let o=Array.isArray(e)?e.length>0?e[0].ownerDocument:document:e.ownerDocument,s=Array.isArray(e)?r?S(e):e:d(e);l=l!=null?l:o.activeElement;let n=(()=>{if(t&5)return 1;if(t&10)return-1;throw new Error("Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last")})(),E=(()=>{if(t&1)return 0;if(t&2)return Math.max(0,s.indexOf(l))-1;if(t&4)return Math.max(0,s.indexOf(l))+1;if(t&8)return s.length-1;throw new Error("Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last")})(),x=t&32?{preventScroll:!0}:{},f=0,i=s.length,u;do{if(f>=i||f+i<=0)return 0;let a=E+f;if(t&16)a=(a+i)%i;else{if(a<0)return 3;if(a>=i)return 1}u=s[a],u==null||u.focus(x),f+=n}while(u!==o.activeElement);return t&6&&H(u)&&u.select(),u.hasAttribute("tabindex")||u.setAttribute("tabindex","0"),2}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/utils/form.js":
/*!***********************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/utils/form.js ***!
  \***********************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "attemptSubmit": function() { return /* binding */ p; },
/* harmony export */   "objectToFormEntries": function() { return /* binding */ e; }
/* harmony export */ });
function e(n={},r=null,t=[]){for(let[i,o]of Object.entries(n))f(t,s(r,i),o);return t}function s(n,r){return n?n+"["+r+"]":r}function f(n,r,t){if(Array.isArray(t))for(let[i,o]of t.entries())f(n,s(r,i.toString()),o);else t instanceof Date?n.push([r,t.toISOString()]):typeof t=="boolean"?n.push([r,t?"1":"0"]):typeof t=="string"?n.push([r,t]):typeof t=="number"?n.push([r,`${t}`]):t==null?n.push([r,""]):e(t,r,n)}function p(n){var t;let r=(t=n==null?void 0:n.form)!=null?t:n.closest("form");if(!!r){for(let i of r.elements)if(i.tagName==="INPUT"&&i.type==="submit"||i.tagName==="BUTTON"&&i.type==="submit"||i.nodeName==="INPUT"&&i.type==="image"){i.click();return}}}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/utils/match.js":
/*!************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/utils/match.js ***!
  \************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "match": function() { return /* binding */ u; }
/* harmony export */ });
function u(r,n,...a){if(r in n){let e=n[r];return typeof e=="function"?e(...a):e}let t=new Error(`Tried to handle "${r}" but there is no handler defined. Only defined handlers are: ${Object.keys(n).map(e=>`"${e}"`).join(", ")}.`);throw Error.captureStackTrace&&Error.captureStackTrace(t,u),t}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/utils/micro-task.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/utils/micro-task.js ***!
  \*****************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "microTask": function() { return /* binding */ t; }
/* harmony export */ });
function t(e){typeof queueMicrotask=="function"?queueMicrotask(e):Promise.resolve().then(e).catch(o=>setTimeout(()=>{throw o}))}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/utils/once.js":
/*!***********************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/utils/once.js ***!
  \***********************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "once": function() { return /* binding */ l; }
/* harmony export */ });
function l(r){let e={called:!1};return(...t)=>{if(!e.called)return e.called=!0,r(...t)}}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/utils/owner.js":
/*!************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/utils/owner.js ***!
  \************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "getOwnerDocument": function() { return /* binding */ e; }
/* harmony export */ });
/* harmony import */ var _ssr_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ssr.js */ "./node_modules/@headlessui/react/dist/utils/ssr.js");
function e(r){return _ssr_js__WEBPACK_IMPORTED_MODULE_0__.isServer?null:r instanceof Node?r.ownerDocument:r!=null&&r.hasOwnProperty("current")&&r.current instanceof Node?r.current.ownerDocument:document}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/utils/platform.js":
/*!***************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/utils/platform.js ***!
  \***************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "isIOS": function() { return /* binding */ o; }
/* harmony export */ });
function o(){return/iPhone/gi.test(window.navigator.platform)||/Mac/gi.test(window.navigator.platform)&&window.navigator.maxTouchPoints>0}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/utils/render.js":
/*!*************************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/utils/render.js ***!
  \*************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Features": function() { return /* binding */ S; },
/* harmony export */   "RenderStrategy": function() { return /* binding */ j; },
/* harmony export */   "compact": function() { return /* binding */ F; },
/* harmony export */   "forwardRefWithAs": function() { return /* binding */ C; },
/* harmony export */   "render": function() { return /* binding */ $; }
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var _match_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./match.js */ "./node_modules/@headlessui/react/dist/utils/match.js");
var S=(a=>(a[a.None=0]="None",a[a.RenderStrategy=1]="RenderStrategy",a[a.Static=2]="Static",a))(S||{}),j=(e=>(e[e.Unmount=0]="Unmount",e[e.Hidden=1]="Hidden",e))(j||{});function $({ourProps:r,theirProps:t,slot:e,defaultTag:a,features:o,visible:n=!0,name:l}){let s=T(t,r);if(n)return p(s,e,a,l);let u=o!=null?o:0;if(u&2){let{static:i=!1,...d}=s;if(i)return p(d,e,a,l)}if(u&1){let{unmount:i=!0,...d}=s;return (0,_match_js__WEBPACK_IMPORTED_MODULE_1__.match)(i?0:1,{[0](){return null},[1](){return p({...d,hidden:!0,style:{display:"none"}},e,a,l)}})}return p(s,e,a,l)}function p(r,t={},e,a){let{as:o=e,children:n,refName:l="ref",...s}=m(r,["unmount","static"]),u=r.ref!==void 0?{[l]:r.ref}:{},i=typeof n=="function"?n(t):n;s.className&&typeof s.className=="function"&&(s.className=s.className(t));let d={};if(t){let f=!1,y=[];for(let[h,g]of Object.entries(t))typeof g=="boolean"&&(f=!0),g===!0&&y.push(h);f&&(d["data-headlessui-state"]=y.join(" "))}if(o===react__WEBPACK_IMPORTED_MODULE_0__.Fragment&&Object.keys(F(s)).length>0){if(!(0,react__WEBPACK_IMPORTED_MODULE_0__.isValidElement)(i)||Array.isArray(i)&&i.length>1)throw new Error(['Passing props on "Fragment"!',"",`The current component <${a} /> is rendering a "Fragment".`,"However we need to passthrough the following props:",Object.keys(s).map(f=>`  - ${f}`).join(`
`),"","You can apply a few solutions:",['Add an `as="..."` prop, to ensure that we render an actual element instead of a "Fragment".',"Render a single element as the child so that we can forward the props onto that element."].map(f=>`  - ${f}`).join(`
`)].join(`
`));return (0,react__WEBPACK_IMPORTED_MODULE_0__.cloneElement)(i,Object.assign({},T(i.props,F(m(s,["ref"]))),d,u,w(i.ref,u.ref)))}return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(o,Object.assign({},m(s,["ref"]),o!==react__WEBPACK_IMPORTED_MODULE_0__.Fragment&&u,o!==react__WEBPACK_IMPORTED_MODULE_0__.Fragment&&d),i)}function w(...r){return{ref:r.every(t=>t==null)?void 0:t=>{for(let e of r)e!=null&&(typeof e=="function"?e(t):e.current=t)}}}function T(...r){var a;if(r.length===0)return{};if(r.length===1)return r[0];let t={},e={};for(let o of r)for(let n in o)n.startsWith("on")&&typeof o[n]=="function"?((a=e[n])!=null||(e[n]=[]),e[n].push(o[n])):t[n]=o[n];if(t.disabled||t["aria-disabled"])return Object.assign(t,Object.fromEntries(Object.keys(e).map(o=>[o,void 0])));for(let o in e)Object.assign(t,{[o](n,...l){let s=e[o];for(let u of s){if((n instanceof Event||(n==null?void 0:n.nativeEvent)instanceof Event)&&n.defaultPrevented)return;u(n,...l)}}});return t}function C(r){var t;return Object.assign((0,react__WEBPACK_IMPORTED_MODULE_0__.forwardRef)(r),{displayName:(t=r.displayName)!=null?t:r.name})}function F(r){let t=Object.assign({},r);for(let e in t)t[e]===void 0&&delete t[e];return t}function m(r,t=[]){let e=Object.assign({},r);for(let a of t)a in e&&delete e[a];return e}


/***/ }),

/***/ "./node_modules/@headlessui/react/dist/utils/ssr.js":
/*!**********************************************************!*\
  !*** ./node_modules/@headlessui/react/dist/utils/ssr.js ***!
  \**********************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "isServer": function() { return /* binding */ e; }
/* harmony export */ });
const e=typeof window=="undefined"||typeof document=="undefined";


/***/ }),

/***/ "./node_modules/@heroicons/react/outline/esm/CheckCircleIcon.js":
/*!**********************************************************************!*\
  !*** ./node_modules/@heroicons/react/outline/esm/CheckCircleIcon.js ***!
  \**********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");


function CheckCircleIcon(props, svgRef) {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement("svg", Object.assign({
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 24 24",
    strokeWidth: 2,
    stroke: "currentColor",
    "aria-hidden": "true",
    ref: svgRef
  }, props), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement("path", {
    strokeLinecap: "round",
    strokeLinejoin: "round",
    d: "M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
  }));
}

const ForwardRef = react__WEBPACK_IMPORTED_MODULE_0__.forwardRef(CheckCircleIcon);
/* harmony default export */ __webpack_exports__["default"] = (ForwardRef);

/***/ }),

/***/ "./node_modules/@heroicons/react/solid/esm/XIcon.js":
/*!**********************************************************!*\
  !*** ./node_modules/@heroicons/react/solid/esm/XIcon.js ***!
  \**********************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");


function XIcon(props, svgRef) {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement("svg", Object.assign({
    xmlns: "http://www.w3.org/2000/svg",
    viewBox: "0 0 20 20",
    fill: "currentColor",
    "aria-hidden": "true",
    ref: svgRef
  }, props), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__.createElement("path", {
    fillRule: "evenodd",
    d: "M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z",
    clipRule: "evenodd"
  }));
}

const ForwardRef = react__WEBPACK_IMPORTED_MODULE_0__.forwardRef(XIcon);
/* harmony default export */ __webpack_exports__["default"] = (ForwardRef);

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!*****************************!*\
  !*** ./assets/src/Index.js ***!
  \*****************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _AddonDashboardApp_pages_settings_SettingsIcons__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @AddonDashboardApp/pages/settings/SettingsIcons */ "./assets/src/dashboard-app/pages/settings/SettingsIcons.js");
/* harmony import */ var _AddonDashboardApp_pages_settings_RollBack__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @AddonDashboardApp/pages/settings/RollBack */ "./assets/src/dashboard-app/pages/settings/RollBack.js");
/* harmony import */ var _AddonDashboardApp_pages_settings_BetaUpdates__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @AddonDashboardApp/pages/settings/BetaUpdates */ "./assets/src/dashboard-app/pages/settings/BetaUpdates.js");
/* harmony import */ var _AddonDashboardApp_pages_settings_LicenseKey__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @AddonDashboardApp/pages/settings/LicenseKey */ "./assets/src/dashboard-app/pages/settings/LicenseKey.js");
/* harmony import */ var _AddonDashboardApp_pages_settings_FileGeneration__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @AddonDashboardApp/pages/settings/FileGeneration */ "./assets/src/dashboard-app/pages/settings/FileGeneration.js");
/* harmony import */ var _AddonDashboardApp_pages_settings_AssetReGeneration__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @AddonDashboardApp/pages/settings/AssetReGeneration */ "./assets/src/dashboard-app/pages/settings/AssetReGeneration.js");
/* harmony import */ var _AddonDashboardApp_pages_settings_WhiteLabel__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @AddonDashboardApp/pages/settings/WhiteLabel */ "./assets/src/dashboard-app/pages/settings/WhiteLabel.js");
/* harmony import */ var _AddonDashboardApp_pages_settings_WhiteLabelForm__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! @AddonDashboardApp/pages/settings/WhiteLabelForm */ "./assets/src/dashboard-app/pages/settings/WhiteLabelForm.js");












/**
 * Add licensing status to main navigation in admin part.
 *
 * @returns html
 */
wp.hooks.addFilter('astra_dashboard.after_navigation_version', 'astra_addon/dashboard_app', function (markup) {
  if (astra_addon_admin.is_bsf_package) {
    markup = astra_addon_admin.license_status ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "pl-3 text-[#4AB866]"
    }, " ", (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('License activated', 'astra-addon'), " ") : (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "pl-3"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      className: "hover:text-astra text-slate-400",
      href: `admin.php?page=${astra_admin.home_slug}&path=settings`
    }, " ", (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('License not activated', 'astra-addon'), " "));
  }
  return markup;
});

/**
 * Remove Free-vs-Pro tab from admin screen.
 *
 * @returns html
 */
wp.hooks.addFilter('astra_dashboard.main_navigation', 'astra_addon/dashboard_app', function (navigation) {
  navigation.pop();
  return navigation;
});

/**
 * Update settings navigation for pro specific features.
 *
 * @returns object
 */
wp.hooks.addFilter('astra_dashboard.settings_navigation', 'astra_addon/dashboard_app', function (navigation) {
  let showVersionControlTab = true;
  if (!astra_admin.show_self_branding && !astra_addon_admin.license_status) {
    showVersionControlTab = false;
  }
  if (!astra_addon_admin.is_bsf_package) {
    showVersionControlTab = false;
  }
  if (showVersionControlTab) {
    navigation.push({
      name: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Version Control', 'astra-addon'),
      slug: 'version-control',
      icon: _AddonDashboardApp_pages_settings_SettingsIcons__WEBPACK_IMPORTED_MODULE_3__["default"]["version-control"]
    });
  }
  if (astra_admin.show_self_branding) {
    navigation.push({
      name: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('White Label', 'astra-addon'),
      slug: 'white-label',
      icon: _AddonDashboardApp_pages_settings_SettingsIcons__WEBPACK_IMPORTED_MODULE_3__["default"]["white-label"]
    });
  }
  return navigation;
});

/**
 * Insert Astra Pro for inside changelog tab.
 *
 * @returns object
 */
wp.hooks.addFilter('astra_dashboard.changelog_products', 'astra_addon/dashboard_app', function (changelogNav) {
  changelogNav.push({
    name: "Astra Pro",
    value: "astra-pro"
  });
  return changelogNav;
});

/**
 * Insert settings sub wrapper pages in extended parts of settings.
 *
 * @returns array
 */
wp.hooks.addFilter('astra_dashboard.settings_tab_wrappers', 'astra_addon/dashboard_app', function (wrappers) {
  if (astra_addon_admin.is_bsf_package) {
    if (astra_admin.show_self_branding) {
      wrappers['version-control'] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, " ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_pages_settings_RollBack__WEBPACK_IMPORTED_MODULE_4__["default"], null), " ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_pages_settings_BetaUpdates__WEBPACK_IMPORTED_MODULE_5__["default"], null), " ");
      wrappers['white-label'] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, " ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_pages_settings_WhiteLabelForm__WEBPACK_IMPORTED_MODULE_10__["default"], null), " ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_pages_settings_WhiteLabel__WEBPACK_IMPORTED_MODULE_9__["default"], null), " ");
    } else {
      wrappers['version-control'] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, " ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_pages_settings_RollBack__WEBPACK_IMPORTED_MODULE_4__["default"], null), " ");
    }
  } else {
    if (astra_admin.show_self_branding) {
      wrappers['white-label'] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, " ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_pages_settings_WhiteLabelForm__WEBPACK_IMPORTED_MODULE_10__["default"], null), " ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_pages_settings_WhiteLabel__WEBPACK_IMPORTED_MODULE_9__["default"], null), " ");
    }
  }
  return wrappers;
});

/**
 * Insert License setting wrap on settings page after Global theme settings.
 *
 * @returns html
 */
wp.hooks.addFilter('astra_dashboard.settings_screen_before_global-settings', 'astra_addon/dashboard_app', function (prevComponent) {
  if (astra_addon_admin.is_bsf_package) {
    prevComponent = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, " ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_pages_settings_LicenseKey__WEBPACK_IMPORTED_MODULE_6__["default"], null), " ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_pages_settings_FileGeneration__WEBPACK_IMPORTED_MODULE_7__["default"], null), " ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_pages_settings_AssetReGeneration__WEBPACK_IMPORTED_MODULE_8__["default"], null), " ");
  } else {
    prevComponent = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, " ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_pages_settings_FileGeneration__WEBPACK_IMPORTED_MODULE_7__["default"], null), " ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_pages_settings_AssetReGeneration__WEBPACK_IMPORTED_MODULE_8__["default"], null), " ");
  }
  return prevComponent;
});

/**
 * Insert License setting wrap on Welcome page after external integrations.
 *
 * @returns html
 */
wp.hooks.addFilter('astra_dashboard.welcome_screen_after_integrations', 'astra_addon/dashboard_app', function (prevComponent) {
  if (astra_addon_admin.is_bsf_package) {
    prevComponent = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_AddonDashboardApp_pages_settings_LicenseKey__WEBPACK_IMPORTED_MODULE_6__["default"], null);
  }
  return prevComponent;
});
}();
/******/ })()
;
//# sourceMappingURL=dashboard-app.js.map