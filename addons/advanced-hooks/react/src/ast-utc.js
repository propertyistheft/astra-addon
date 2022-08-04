import { __ } from "@wordpress/i18n";
import { __experimentalGetSettings as getDateSettings } from "@wordpress/date";
/**
 * Displays timezone information when user timezone is different from site timezone.
 */
const AstUTC = () => {
	const { timezone } = getDateSettings();

	// Convert timezone offset to hours.
	const userTimezoneOffset = -1 * (new Date().getTimezoneOffset() / 60);

	// System timezone and user timezone match, nothing needed.
	// Compare as numbers because it comes over as string.
	if (Number(timezone.offset) === userTimezoneOffset) {
		return null;
	}

	const offsetSymbol = timezone.offset >= 0 ? "+" : "";
	const zoneAbbr =
		"" !== timezone.abbr && isNaN(timezone.abbr)
			? timezone.abbr
			: `UTC${offsetSymbol}${timezone.offset}`;

	const timezoneDetail =
		"UTC" === timezone.string
			? __("Coordinated Universal Time")
			: `(${zoneAbbr}) ${timezone.string.replace("_", " ")}`;

	return (
			<div className="ast-timezone" title="Change WordPress timezone setting.">
				<a target="_blank" href={astCustomLayout.siteurl+"/wp-admin/options-general.php"}>{zoneAbbr}</a>
			</div>
	);
};

export default AstUTC;
