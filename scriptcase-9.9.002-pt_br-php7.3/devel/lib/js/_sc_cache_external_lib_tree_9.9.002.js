function scExternalLibTree(divID, fieldID, fileExtensionList, onChangeFunction) {
	$("#" + divID).jstree({
		"plugins": ["conditionalselect"],
		"conditionalselect": function(node) {
			return this.is_leaf(node) && !node.children.length && !$("#" + node.id).hasClass("sc-is-dir");
		},
		"core": {
			"multiple": false,
			"data": {
				"url": function(node) {
					var nodePath = "", startingFile = "";
					if ("#" !== node.id) {
						nodePath += node.id;
					}
					else {
						startingFile = "&starting_file=" + $("#" + fieldID).val();
					}
					if (!fileExtensionList) {
						fileExtensionList = [];
					}
					return "external_lib_tree.php?extensions=" + fileExtensionList.join("__SEP__") + startingFile + "&node_path=" + nodePath;
				},
				"data": function (node) {
					return {"id": node.id};
				}
			}
		}
	}).on("changed.jstree", function(e, data) {
		$("#" + fieldID).val(data.node.id);
		if (onChangeFunction) {
			onChangeFunction();
		}
	});
}