(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_Pages_Employees_Edit_TopBar_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Employees/Edit/TopBar.vue?vue&type=script&lang=js":
/*!**********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Employees/Edit/TopBar.vue?vue&type=script&lang=js ***!
  \**********************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: {
    current: Number,
    employee: {
      "default": '',
      required: false
    }
  },
  data: function data() {
    return {
      steps: [{
        id: 'A',
        name: 'Employee Details',
        href: route('employees.edit', this.employee),
        status: true
      }, {
        id: 'B',
        name: 'Identification Details',
        href: route('employees.edit.identification.index', this.employee),
        status: true
      }, {
        id: 'C',
        name: 'Contact Details',
        href: route('employees.edit.contact-details.index', this.employee),
        status: true
      }, {
        id: 'D',
        name: 'Contribution',
        href: route('employees.edit.contributions.index', this.employee),
        status: true
      }, {
        id: 'E',
        name: 'Bank Details',
        href: route('employees.edit.bank-details.index', this.employee),
        status: true
      }, {
        id: 'F',
        name: 'Salary Details',
        href: route('employees.edit.salary-details.index', this.employee),
        status: true
      }, {
        id: 'G',
        name: 'Annual Leave',
        href: route('employees.edit.annual-leave.index', this.employee),
        status: true
      }]
    };
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Employees/Edit/TopBar.vue?vue&type=template&id=a785ef80":
/*!**************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Employees/Edit/TopBar.vue?vue&type=template&id=a785ef80 ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "aria-label": "Progress"
};
var _hoisted_2 = {
  "class": "border border-gray-300 rounded-md divide-y divide-gray-300 md:flex md:divide-y-0"
};
var _hoisted_3 = {
  "class": "px-4 py-3 flex items-center text-sm font-medium"
};
var _hoisted_4 = {
  "class": "flex-shrink-0 w-8 h-8 flex items-center justify-center border-2 border-gray-300 rounded-full group-hover:border-gray-400"
};
var _hoisted_5 = {
  "class": "text-gray-500 group-hover:text-gray-900"
};
var _hoisted_6 = {
  "class": "ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900"
};
var _hoisted_7 = {
  "class": "ml-4 text-sm font-medium text-cyan-600"
};

var _hoisted_8 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", {
  "class": "hidden md:block absolute top-0 right-0 h-full w-5",
  "aria-hidden": "true"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("svg", {
  "class": "h-full w-full text-gray-300",
  viewBox: "0 0 22 80",
  fill: "none",
  preserveAspectRatio: "none"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("path", {
  d: "M0 -2L20 40L0 82",
  "vector-effect": "non-scaling-stroke",
  stroke: "currentcolor",
  "stroke-linejoin": "round"
})])], -1
/* HOISTED */
);

function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_inertia_link = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("inertia-link");

  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("nav", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("ol", _hoisted_2, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.steps, function (step, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("li", {
      key: step.name,
      "class": "relative md:flex-1 md:flex"
    }, [_ctx.route().current('employees.create') ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("span", {
      key: 0,
      href: step.href,
      "class": "group flex items-center"
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", _hoisted_5, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(step.id), 1
    /* TEXT */
    )]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", _hoisted_6, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(step.name), 1
    /* TEXT */
    )])], 8
    /* PROPS */
    , ["href"])) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_inertia_link, {
      key: 1,
      href: step.href,
      "class": "px-4 py-3 flex items-center text-sm font-medium",
      "aria-current": "step"
    }, {
      "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
        return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", {
          "class": ["flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full", {
            'bg-cyan-600 group-hover:bg-green-800': step.href === $props.current,
            'border-2 border-cyan-600': step.current !== $props.current
          }]
        }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", {
          "class": {
            'text-white': step.current === $props.current,
            'text-cyan-600': step.current !== $props.current
          }
        }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(step.id), 3
        /* TEXT, CLASS */
        )], 2
        /* CLASS */
        ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", _hoisted_7, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(step.name), 1
        /* TEXT */
        )];
      }),
      _: 2
      /* DYNAMIC */

    }, 1032
    /* PROPS, DYNAMIC_SLOTS */
    , ["href"])), index !== $data.steps.length - 1 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 2
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Arrow separator for lg screens and up "), _hoisted_8], 2112
    /* STABLE_FRAGMENT, DEV_ROOT_FRAGMENT */
    )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]);
  }), 128
  /* KEYED_FRAGMENT */
  ))])]);
}

/***/ }),

/***/ "./resources/js/Pages/Employees/Edit/TopBar.vue":
/*!******************************************************!*\
  !*** ./resources/js/Pages/Employees/Edit/TopBar.vue ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _TopBar_vue_vue_type_template_id_a785ef80__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./TopBar.vue?vue&type=template&id=a785ef80 */ "./resources/js/Pages/Employees/Edit/TopBar.vue?vue&type=template&id=a785ef80");
/* harmony import */ var _TopBar_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./TopBar.vue?vue&type=script&lang=js */ "./resources/js/Pages/Employees/Edit/TopBar.vue?vue&type=script&lang=js");



_TopBar_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.render = _TopBar_vue_vue_type_template_id_a785ef80__WEBPACK_IMPORTED_MODULE_0__.render
/* hot reload */
if (false) {}

_TopBar_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.__file = "resources/js/Pages/Employees/Edit/TopBar.vue"

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_TopBar_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default);

/***/ }),

/***/ "./resources/js/Pages/Employees/Edit/TopBar.vue?vue&type=script&lang=js":
/*!******************************************************************************!*\
  !*** ./resources/js/Pages/Employees/Edit/TopBar.vue?vue&type=script&lang=js ***!
  \******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TopBar_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__.default)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TopBar_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./TopBar.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Employees/Edit/TopBar.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/Pages/Employees/Edit/TopBar.vue?vue&type=template&id=a785ef80":
/*!************************************************************************************!*\
  !*** ./resources/js/Pages/Employees/Edit/TopBar.vue?vue&type=template&id=a785ef80 ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TopBar_vue_vue_type_template_id_a785ef80__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TopBar_vue_vue_type_template_id_a785ef80__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./TopBar.vue?vue&type=template&id=a785ef80 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Employees/Edit/TopBar.vue?vue&type=template&id=a785ef80");


/***/ })

}]);