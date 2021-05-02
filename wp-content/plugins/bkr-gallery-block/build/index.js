/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/index.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__);




Object(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__["registerBlockType"])("bkr-blocks/gallery-block", {
  title: "BKR Gallery",
  category: "media",
  icon: "format-gallery",
  attributes: {
    images: {
      type: "array",
      default: []
    },
    button_location: {
      type: "string",
      default: "image"
    },
    thumbnails: {
      type: "string",
      default: "none"
    },
    indicators: {
      type: "string",
      default: "bullet"
    },
    fullscreen: {
      type: "bool",
      default: false
    },
    interval: {
      type: "int",
      default: 0
    },
    advanced_mode: {
      type: "bool",
      default: false
    }
  },
  edit: function edit(props) {
    var addImages = function addImages(images) {
      images = images.map(function (image) {
        var already_have_image = false;
        var old_image_object = null; // Check if we already have the image in the attributes so that we don't overwrite any changes the user made

        props.attributes.images.map(function (existing_image) {
          if (image.url === existing_image.object.url) {
            already_have_image = true;
            old_image_object = existing_image;
          }
        });

        if (already_have_image) {
          return {
            object: image,
            overlay_text: old_image_object.overlay_text,
            overlay_text_color: old_image_object.overlay_text_color,
            overlay_background: old_image_object.overlay_background,
            // overlay_width: old_image_object.overlay_width,
            // overlay_height: old_image_object.overlay_height,
            overlay_text_position: old_image_object.overlay_text_position,
            overlay_text_margins: old_image_object.overlay_text_margins
          };
        } else {
          return {
            object: image,
            overlay_text: "",
            overlay_text_color: "",
            overlay_background: "",
            // overlay_width: "",
            // overlay_height: "",
            overlay_text_position: "",
            overlay_text_margins: ""
          };
        }
      });
      props.setAttributes({
        images: images
      });
    };

    var changeOverlayText = function changeOverlayText(value, index) {
      // "let images = props.attributes.images" won't work, because it is actually a reference, not a copy.
      // By modifying a reference, it changes the original object it refers to, and directly modifying "props.attributes"
      // does not change the state of the update button in gutenberg, you have to edit it through "props.setAttributes", BUT "props.setAttributes"
      // checks to see if the attributes that you are setting is different from the old attributes and since we edited the reference
      // it has already changed, so there is no way to change the state of the update button legitimately (that I can think of, I'm tired)
      // this hack below prevents referencing by cloning the ENTIRE object by stringifying and then parsing back to an object (which is bad),
      // but honestly, it works and I've been stuck on this for more than a day now.
      var images = JSON.parse(JSON.stringify(props.attributes.images));
      images[index].overlay_text = value;
      props.setAttributes({
        images: images
      });
    };

    var changeOverlayBackground = function changeOverlayBackground(value, index) {
      var images = JSON.parse(JSON.stringify(props.attributes.images)); // REFER TO COMMENT ABOVE FOR EXPLANATION

      images[index].overlay_background = value;
      props.setAttributes({
        images: images
      });
    };

    var changeOverlayTextColor = function changeOverlayTextColor(value, index) {
      var images = JSON.parse(JSON.stringify(props.attributes.images)); // REFER TO COMMENT ABOVE FOR EXPLANATION

      images[index].overlay_text_color = value;
      props.setAttributes({
        images: images
      });
    }; //	const changeOverlayWidth = ( value, index ) => {
    //		let images = JSON.parse(JSON.stringify(props.attributes.images)); // REFER TO COMMENT ABOVE FOR EXPLANATION
    //		images[index].overlay_width = value;
    //		props.setAttributes( { images: images } );
    //	}
    //	const changeOverlayHeight = ( value, index ) => {
    //		let images = JSON.parse(JSON.stringify(props.attributes.images)); // REFER TO COMMENT ABOVE FOR EXPLANATION
    //		images[index].overlay_height = value;
    //		props.setAttributes( { images: images } );
    //	}


    var changeOverlayTextPosition = function changeOverlayTextPosition(value, index) {
      var images = JSON.parse(JSON.stringify(props.attributes.images)); // REFER TO COMMENT ABOVE FOR EXPLANATION

      images[index].overlay_text_position = value;
      props.setAttributes({
        images: images
      });
    };

    var changeOverlayTextMargins = function changeOverlayTextMargins(value, index) {
      var images = JSON.parse(JSON.stringify(props.attributes.images)); // REFER TO COMMENT ABOVE FOR EXPLANATION

      images[index].overlay_text_margins = value;
      props.setAttributes({
        images: images
      });
    };

    var removeImage = function removeImage(index) {
      var images = JSON.parse(JSON.stringify(props.attributes.images)); // REFER TO COMMENT ABOVE FOR EXPLANATION

      images.splice(index, 1);
      props.setAttributes({
        images: images
      });
    };

    var removeImages = function removeImages() {
      props.setAttributes({
        images: []
      });
    };

    var controls = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__["InspectorControls"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: "components-panel__body is-opened"
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: "bkr-gallery-block-inspector-controls-item"
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("label", {
      for: "bkr-gallery-block-button_location"
    }, "Button Location"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("select", {
      id: "bkr-gallery-block-button_location",
      onChange: function onChange(e) {
        props.setAttributes({
          button_location: e.target.value
        });
      }
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
      value: "image",
      selected: props.attributes.button_location === "image" ? true : false
    }, "Image"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
      value: "indicators",
      selected: props.attributes.button_location === "indicators" ? true : false
    }, "Indicators"))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: "bkr-gallery-block-inspector-controls-item"
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("label", {
      for: "bkr-gallery-block-thumbnails"
    }, "Thumbnails"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("select", {
      id: "bkr-gallery-block-thumbnails",
      onChange: function onChange(e) {
        props.setAttributes({
          thumbnails: e.target.value
        });
      }
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
      value: "none",
      selected: props.attributes.thumbnails === "none" ? true : false
    }, "None"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
      value: "wrap",
      selected: props.attributes.thumbnails === "wrap" ? true : false
    }, "Wrap"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
      value: "scroll",
      selected: props.attributes.thumbnails === "scroll" ? true : false
    }, "Scroll"))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: "bkr-gallery-block-inspector-controls-item"
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("label", {
      for: "bkr-gallery-block-indicators"
    }, "Indicators"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("select", {
      id: "bkr-gallery-block-indicators",
      onChange: function onChange(e) {
        props.setAttributes({
          indicators: e.target.value
        });
      }
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
      value: "none",
      selected: props.attributes.indicators === "none" ? true : false
    }, "None"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
      value: "bullet",
      selected: props.attributes.indicators === "bullet" ? true : false
    }, "Bullets"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
      value: "number",
      selected: props.attributes.indicators === "number" ? true : false
    }, "Numbered"))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: "bkr-gallery-block-inspector-controls-item"
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("label", {
      for: "bkr-gallery-block-interval"
    }, "Interval between slides (0 to disable)"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("input", {
      id: "bkr-gallery-block-interval",
      type: "number",
      value: props.attributes.interval,
      onChange: function onChange(e) {
        props.setAttributes({
          interval: e.target.value
        });
      }
    })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: "bkr-gallery-block-inspector-controls-item checkbox"
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("label", {
      for: "bkr-gallery-block-fullscreen"
    }, "Enable Fullscreen preview"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("input", {
      id: "bkr-gallery-block-fullscreen",
      type: "checkbox",
      checked: props.attributes.fullscreen ? true : false,
      onChange: function onChange(e) {
        props.setAttributes({
          fullscreen: e.target.checked
        });
      }
    })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: "bkr-gallery-block-inspector-controls-item checkbox"
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("label", {
      for: "bkr-gallery-block-advanced_mode"
    }, "Enable Advanced Mode"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("input", {
      id: "bkr-gallery-block-advanced_mode",
      type: "checkbox",
      checked: props.attributes.advanced_mode ? true : false,
      onChange: function onChange(e) {
        props.setAttributes({
          advanced_mode: e.target.checked
        });
      }
    }))));
    return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["Fragment"], null, controls, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      style: {
        display: "flex",
        flexWrap: "wrap"
      }
    }, function () {
      if (props.attributes.advanced_mode) {
        return props.attributes.images.map(function (image, index) {
          return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
            className: "bkr-gallery-block-image_preview"
          }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("img", {
            src: image.object.url
          }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("textarea", {
            placeholder: "Overlay Text",
            onChange: function onChange(e) {
              changeOverlayText(e.target.value, index);
            }
          }, image.overlay_text), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("select", {
            onChange: function onChange(e) {
              changeOverlayBackground(e.target.value, index);
            }
          }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "",
            selected: image.overlay_background === "" ? true : false
          }, "Overlay Backround"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "#ff000040",
            selected: image.overlay_background === "#ff000040" ? true : false
          }, "Red"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "#00ff0040",
            selected: image.overlay_background === "#00ff0040" ? true : false
          }, "Green"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "#0000ff40",
            selected: image.overlay_background === "#0000ff40" ? true : false
          }, "Blue"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "#00000040",
            selected: image.overlay_background === "#00000040" ? true : false
          }, "Black"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "#ffffff40",
            selected: image.overlay_background === "#ffffff40" ? true : false
          }, "White")), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("select", {
            onChange: function onChange(e) {
              changeOverlayTextColor(e.target.value, index);
            }
          }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "",
            selected: image.overlay_text_color === "" ? true : false
          }, "Overlay Text Color"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "#ff0000",
            selected: image.overlay_text_color === "#ff0000" ? true : false
          }, "Red"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "#00ff00",
            selected: image.overlay_text_color === "#00ff00" ? true : false
          }, "Green"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "#0000ff",
            selected: image.overlay_text_color === "#0000ff" ? true : false
          }, "Blue"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "#000000",
            selected: image.overlay_text_color === "#000000" ? true : false
          }, "Black"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "#ffffff",
            selected: image.overlay_text_color === "#ffffff" ? true : false
          }, "White")), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("select", {
            onChange: function onChange(e) {
              changeOverlayTextPosition(e.target.value, index);
            }
          }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "",
            selected: image.position === "" ? true : false
          }, "Overlay Text Position"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "top_left",
            selected: image.position === "top_left" ? true : false
          }, "Top Left"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "top_center",
            selected: image.position === "top_center" ? true : false
          }, "Top Center"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "top_right",
            selected: image.position === "top_right" ? true : false
          }, "Top Right"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "middle_left",
            selected: image.position === "middle_left" ? true : false
          }, "Middle Left"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "middle_center",
            selected: image.position === "middle_center" ? true : false
          }, "Middle Center"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "middle_right",
            selected: image.position === "middle_right" ? true : false
          }, "Middle Right"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "bottom_left",
            selected: image.position === "bottom_right" ? true : false
          }, "Bottom Left"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "bottom_center",
            selected: image.position === "bottom_center" ? true : false
          }, "Bottom Center"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
            value: "bottom_right",
            selected: image.position === "bottom_left" ? true : false
          }, "Bottom Right")), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__["Button"], {
            onClick: function onClick() {
              removeImage(index);
            },
            style: {
              margin: "5px",
              display: "flex",
              justifyContent: "center"
            },
            isDestructive: true
          }, "Remove Image"));
        });
      } else {
        return props.attributes.images.map(function (image, index) {
          return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
            className: "bkr-gallery-block-image_preview"
          }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("img", {
            src: image.object.url
          }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("textarea", {
            placeholder: "Overlay Text",
            onChange: function onChange(e) {
              changeOverlayText(e.target.value, index);
            }
          }, image.overlay_text), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__["Button"], {
            onClick: function onClick() {
              removeImage(index);
            },
            style: {
              margin: "5px"
            },
            isDestructive: true
          }, "Remove Image"));
        });
      }
    }()), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__["MediaUploadCheck"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__["MediaUpload"], {
      onSelect: addImages,
      multiple: true,
      value: props.attributes.images.map(function (image) {
        return image.object.id;
      }),
      render: function render(_ref) {
        var open = _ref.open;
        return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__["Button"], {
          onClick: open,
          style: {
            margin: "5px"
          },
          isPrimary: true
        }, "Add Images");
      }
    })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__["Button"], {
      onClick: removeImages,
      style: {
        margin: "5px"
      },
      isDestructive: true
    }, "Remove Images")));
  },
  save: function save() {
    return null;
  }
});

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["wp"]["blockEditor"]; }());

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["wp"]["blocks"]; }());

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["wp"]["components"]; }());

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["wp"]["element"]; }());

/***/ })

/******/ });
//# sourceMappingURL=index.js.map