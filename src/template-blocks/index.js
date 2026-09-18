/**
 * One combined file for the editor code of every Blockive Template Block.
 *
 * This is the only place that calls registerBlockType() for these blocks.
 * Their block.json files do not list an `editorScript`. Instead, this file
 * is loaded by hand, only on the `blockive_template` editor screen (see
 * Bpafb_Template_Blocks::enqueue_editor_assets). That is what keeps these
 * blocks out of every other editor's block list, while render.php still
 * works wherever a template is shown on the live site.
 */
import './style.css';

// Post / Core Template Blocks.
import './post';

// Pro-only Template Blocks (WooCommerce, Events, Dynamic Field). These are
// just locked "(Pro)" placeholders here, shown in the block list.
import './pro-teasers';
