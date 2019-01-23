var fwThzSectionBuilder = {};

/**
 * @param {String} [prefix]
 */
fwThzSectionBuilder.uniqueShortcode = function(prefix) {
	prefix = prefix || 'shortcode_';

	var shortcode = prefix + fw.randomMD5().substring(0, 7);

	shortcode = shortcode.replace(/-/g, '_');

	return shortcode;
};



fwThzSectionBuilder.setOrder = function(maxN) {

	var globalOrder = _.range(0,maxN);
	globalOrder = _.map(globalOrder, function() { return true; });
	return globalOrder;

};