/**
 * MultirowsWidget jscript file.
 *
 * @author Victor Kozmin <promcalc@gmail.com>
 * @license http://directory.fsf.org/wiki/License:BSD_3Clause
 */

function Multirow(param) {
	var getAllRows = function(){ return jQuery(param.rowclass); },
		setDeleteLinkProp = function(oLink, index) {
			oLink
				.attr("id", param.model + "_" + index + "_")
				.on("click", function(event) {
					event.preventDefault
					var sId = jQuery(this).attr("id"),
						settings = jQuery(param.formselector).data('settings'),
						aAttributes = settings.attributes,
						regExp = new RegExp('^' + sId);

					for(i = 0, nMax = aAttributes.length; i < nMax; i++) {
						regExp.lastIndex = 0;
						if( regExp.test(aAttributes[i].id) ) {
							aAttributes.splice(i, 1);
							nMax -= 1;
							i -= 1;
						}
					}

					jQuery(this).parents(param.rowclass).first().remove();
					aRows = getAllRows();
					return false;
				});
		},
		aRows = getAllRows(),
		oAddLink = jQuery(param.addlinkselector),
		nMaxIndex = 0,
		sReg = param.model + "\\[([^\\]]+)\\]\\[([^\\]]+)\\]",
		modelreg = new RegExp(sReg);

	aRows.each(function(index) {
		var ob = jQuery(this),
			oField = ob.find( "[name^='" + param.model + "']").first(),
			sName = oField.attr('name'),
			a = modelreg.exec(sName),
			nIndex = parseInt(a[1]);

		modelreg.modelreg = 0;

		if( nMaxIndex < nIndex ) {
			nMaxIndex = nIndex;
		}

		if( index == 0 ) {
			ob.hide();
		}
		else {
			setDeleteLinkProp(
				ob.find(param.dellinkselector),
				nIndex
			);

		}
	});

	oAddLink
		.off("click")
		.on("click", function(event){
			event.preventDefault;

			var settings = jQuery(param.formselector).data('settings'),
				aAttributes = settings.attributes,
				sTemplate = param.model + '_0_',
				regExp = new RegExp('^' + sTemplate),
				aExt = {
					validationDelay: settings.validationDelay,
					validateOnChange: settings.validateOnChange,
					validateOnType: settings.validateOnType,
					hideErrorMessage: settings.hideErrorMessage,
					inputContainer: settings.inputContainer,
					errorCssClass: settings.errorCssClass,
					successCssClass: settings.successCssClass,
					beforeValidateAttribute: settings.beforeValidateAttribute,
					afterValidateAttribute: settings.afterValidateAttribute,
					validatingCssClass: settings.validatingCssClass,
					enableAjaxValidation: true,
					status: 1,
					summary: true
				};

			for(i = 0, nMax = aAttributes.length; i < nMax; i++) {
				regExp.lastIndex = 0;
				if( regExp.test(aAttributes[i].id) ) {
					aAttributes.splice(i, 1);
					nMax -= 1;
					i -= 1;
				}
			}
			
			var oNew = aRows.first().clone(),
				aFields = oNew.find( "[name^='" + param.model + "']");
			nMaxIndex += 1;

			aFields.each(function(index){
				var ob = jQuery(this),
					sName = ob.attr('name'),
					sId = ob.attr('id'),
					a = modelreg.exec(sName),
					nIndex = parseInt(a[1]),
					sField = a[2],
					sNewName = param.model + "[" + nMaxIndex + "][" + sField + "]",
					sNewId = param.model + "_" + nMaxIndex + "_" + sField;

				ob
					.attr("name", sNewName)
					.attr("id", sNewId);
				oNew
					.find( "[for='" + sId + "']")
					.attr("for", sNewId);
				oNew
					.find( "#" + sId + "_em_")
					.attr("id", sNewId + "_em_");

				var oField = {
					'id': sNewId,
					'inputID': sNewId,
					'errorID': sNewId + "_em_",
					'model': param.model,
					'name': '[' + nMaxIndex + ']' + sField,
				};

				aAttributes.push(
					jQuery.extend(
						{},
						aExt,
						oField
					)
				);
			});
			aRows.last().after(oNew);
			oNew.show();
			setDeleteLinkProp(
				oNew.find(param.dellinkselector),
				nMaxIndex
			);

			aRows = getAllRows();
			return false;
		});
}