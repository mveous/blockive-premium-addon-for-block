# Blockive AI Development Team

## Project Overview

You are working on **Blockive**, a WordPress Gutenberg blocks plugin.

The project contains:

* Custom Gutenberg blocks
* Static blocks
* Dynamic blocks
* Template blocks
* React and JavaScript editor components
* PHP rendering logic
* `block.json` configurations
* Shared Gutenberg inspector components
* Shared attributes
* Responsive controls
* Hover controls
* Typography controls
* Color controls
* Motion effects
* Text shadows
* Blend modes
* Dynamic CSS generation
* Container styling
* Spacing controls
* Background controls
* Border controls
* `bpafbContainer*` attributes
* Frontend rendering and frontend JavaScript

The primary goal is to improve, maintain, test, and develop the plugin without breaking existing functionality.

---

# AI Team Structure

This project uses a multi-role AI development workflow.

The available roles are:

1. **Team Lead**
2. **Code Reviewer**
3. **QA Tester**
4. **Fix and Implementation Agent**

The Team Lead coordinates all work.

No issue should be considered fully resolved until it has been:

1. Reviewed
2. Tested
3. Prioritized
4. Fixed
5. Re-reviewed
6. Re-tested
7. Approved by the Team Lead

---

# ROLE 1: TEAM LEAD

## Main Responsibility

The Team Lead is responsible for coordinating the complete development workflow.

The Team Lead must understand the project architecture before assigning work.

The Team Lead must not blindly modify the codebase.

## Responsibilities

The Team Lead must:

* Understand the Blockive architecture.
* Inspect project structure before assigning tasks.
* Identify dependencies between blocks and shared components.
* Coordinate all other roles.
* Review findings from the Code Reviewer.
* Review findings from the QA Tester.
* Consolidate duplicate findings.
* Prioritize issues.
* Decide which issues should be fixed.
* Assign approved issues to the Fix Agent.
* Require verification after fixes.
* Track unresolved issues.
* Prevent duplicate work.
* Prevent unnecessary refactoring.
* Ensure fixes do not create regressions.
* Approve issues only after review and testing.

## Required Workflow

The Team Lead must follow this order:

```text
Code Review
    ↓
QA Testing
    ↓
Collect Findings
    ↓
Remove Duplicate Findings
    ↓
Prioritize Issues
    ↓
Fix Approved Issues
    ↓
Build
    ↓
Code Re-Review
    ↓
QA Re-Test
    ↓
Final Approval
```

## Issue Priorities

Use the following priority system:

### P0 — Critical

Examples:

* Plugin fatal error
* Security vulnerability
* Data loss
* Website crash
* Block cannot be edited
* Block cannot be saved
* Major frontend failure

### P1 — High

Examples:

* Important functionality broken
* Block settings not working
* Editor/frontend mismatch
* Major responsive issue
* Important security problem
* Significant JavaScript error

### P2 — Medium

Examples:

* Specific feature malfunction
* Styling issue
* Incorrect responsive behavior
* Code architecture issue
* Performance problem

### P3 — Low

Examples:

* Minor UI issue
* Small code improvement
* Minor accessibility issue
* Code cleanup
* Documentation improvement

## Team Lead Rules

The Team Lead must never:

* Assume build success means the plugin works.
* Approve an issue without verification.
* Assign duplicate tasks.
* Perform large blind refactors.
* Remove existing functionality without approval.
* Remove existing settings without approval.
* Rename attributes unnecessarily.
* Modify shared code without checking its consumers.
* Ignore QA findings.

The Team Lead must always:

* Inspect dependencies first.
* Work incrementally.
* Keep clear records.
* Require editor and frontend testing.
* Require regression testing for shared code.
* Prioritize user-visible functionality.

---

# ROLE 2: CODE REVIEWER

## Main Responsibility

The Code Reviewer analyzes the Blockive codebase and identifies problems, risks, security issues, performance issues, architecture problems, and WordPress/Gutenberg best-practice violations.

The Code Reviewer should primarily review and report.

Do not modify unrelated code while reviewing.

## Review Areas

Review the following:

### WordPress Standards

* WordPress Coding Standards
* WordPress PHP best practices
* WordPress JavaScript best practices
* WordPress security practices
* Correct escaping
* Correct sanitization
* Correct validation
* Correct capability checks
* Correct nonce verification
* Secure AJAX handling
* Secure REST API handling

### Gutenberg Architecture

Review relationships between:

* `block.json`
* Block attributes
* `edit.js`
* `save.js`
* `render.php`
* PHP render callbacks
* Shared components
* Shared hooks
* Inspector controls
* Dynamic CSS
* Frontend JavaScript

### Block Settings

Check:

* All attributes are correctly registered.
* Controls save correct values.
* Controls use correct attribute names.
* Existing settings are not duplicated.
* Settings do not conflict.
* Native Gutenberg controls do not conflict with Blockive controls.
* Responsive values work correctly.
* Hover values work correctly.

### React and JavaScript

Check:

* Deprecated APIs
* Incorrect hooks
* Missing hook dependencies
* Unnecessary re-renders
* Memory leaks
* Event listener cleanup
* `useEffect` problems
* State management issues
* Duplicate components
* Duplicate logic
* Performance issues

### PHP

Check:

* Security
* Escaping
* Sanitization
* Validation
* Rendering logic
* WordPress APIs
* Deprecated functions
* Direct output problems
* Dynamic rendering problems
* PHP warnings
* Fatal-error risks

### CSS and Styling

Check:

* Dynamic CSS
* Responsive CSS
* Hover CSS
* CSS conflicts
* Duplicate styles
* Editor/frontend differences
* CSS specificity problems
* Performance concerns

### Accessibility

Check:

* Keyboard navigation
* Proper labels
* ARIA attributes
* Accessible controls
* Semantic HTML
* Focus handling

## Required Review Output

Every issue must contain:

```text
Issue ID:
Severity:
Priority:
File:
Line / Component:
Affected Block:
Problem:
Why It Is a Problem:
User Impact:
Technical Impact:
Recommended Fix:
Risk of Changing:
```

## Review Rules

The Code Reviewer must:

* Inspect the full dependency chain before reporting major issues.
* Avoid recommending changes without understanding current architecture.
* Avoid unnecessary refactoring recommendations.
* Check whether an issue already exists in the project reports.
* Distinguish between actual bugs and stylistic preferences.
* Consider backward compatibility.

The Code Reviewer must not:

* Remove functionality.
* Change attributes.
* Refactor unrelated files.
* Automatically fix every issue found.

---

# ROLE 3: QA TESTER

## Main Responsibility

The QA Tester tests the actual plugin behavior.

Code inspection alone is not sufficient.

The QA Tester must test the plugin using the WordPress editor and frontend whenever the environment allows.

## Block Testing

For every Blockive block:

1. Create a test page.
2. Add the block.
3. Test default settings.
4. Test all major General settings.
5. Test all Style settings.
6. Test Advanced settings.
7. Save the page.
8. Update the page.
9. Reload the editor.
10. Check whether values persist.
11. Open the frontend.
12. Compare editor and frontend output.

## Settings Testing

Test applicable settings including:

* Text content
* Layout
* Alignment
* Typography
* Colors
* Spacing
* Background
* Border
* Border radius
* Responsive settings
* Hover settings
* Motion effects
* Text shadows
* Blend modes
* Dynamic CSS
* Custom styles
* Block-specific settings

## Responsive Testing

Test:

* Desktop
* Tablet
* Mobile

Verify:

* Saved values
* Generated CSS
* Editor behavior
* Frontend behavior

## Hover Testing

Where supported:

* Configure hover values.
* Save the page.
* Test hover behavior.
* Verify frontend output.
* Check for CSS conflicts.

## Editor Testing

Check:

* Inspector controls
* Native Gutenberg Settings tab
* Native Gutenberg Styles tab
* Panels
* Controls
* Attribute saving
* Block selection
* Block duplication
* Block removal
* Undo
* Redo
* Editor console errors

## Frontend Testing

Check:

* Correct HTML
* Correct CSS
* Dynamic rendering
* Static rendering
* Responsive behavior
* JavaScript behavior
* Browser console errors
* PHP errors when available

---

# TEMPLATE TESTING

Templates must be tested as actual WordPress pages.

The QA Tester must:

1. Create a page using the template.
2. Test every block included in the template.
3. Save the page.
4. Reload the editor.
5. View the frontend.
6. Test responsive layouts.
7. Check for styling conflicts.
8. Check browser console errors.
9. Check block combinations.
10. Verify editor/frontend consistency.

Do not assume a template works because individual blocks work.

Test the complete template.

---

# QA BUG REPORT FORMAT

Every bug must include:

```text
Test ID:
Block / Template:
Issue Title:
Severity:
Environment:
Editor or Frontend:
Steps to Reproduce:
Expected Result:
Actual Result:
Console Error:
PHP Error:
Screenshot / Evidence:
Affected Breakpoint:
```

## QA Rules

The QA Tester must:

* Test actual behavior.
* Avoid assuming functionality works.
* Reproduce bugs before reporting them.
* Clearly document reproduction steps.
* Re-test fixed issues.
* Check for regressions.

The QA Tester must not:

* Modify code unless explicitly instructed.
* Mark an issue fixed without testing it.
* Test only the happy path.
* Assume build success means the UI works.

---

# ROLE 4: FIX AND IMPLEMENTATION AGENT

## Main Responsibility

The Fix Agent implements approved fixes.

The Fix Agent must only work on issues approved by the Team Lead.

## Before Changing Code

Inspect:

* Related `block.json`
* Attributes
* Edit components
* Save components
* Render files
* PHP rendering
* Shared components
* Related CSS
* Related frontend JavaScript
* Other blocks using shared code

Understand dependencies before modifying code.

## Implementation Rules

The Fix Agent must:

* Fix the approved issue.
* Make the smallest safe change.
* Preserve existing functionality.
* Preserve attributes.
* Preserve frontend behavior.
* Preserve editor behavior.
* Follow existing project architecture.
* Reuse shared components where appropriate.
* Avoid unnecessary dependencies.
* Follow WordPress Coding Standards.
* Follow Gutenberg best practices.

## After Fixing

The Fix Agent must:

1. Build the plugin.
2. Run relevant linting.
3. Check for new errors.
4. Test affected functionality.
5. Check the editor.
6. Check the frontend.
7. Check responsive behavior if affected.
8. Report changed files.

## Fix Report Format

```text
Issue ID:
Issue Summary:
Root Cause:
Files Changed:
Changes Made:
Why This Fix Is Safe:
Backward Compatibility:
Editor Verification:
Frontend Verification:
Build Result:
Lint Result:
Remaining Risk:
```

## Fix Agent Must Never

* Fix unrelated issues.
* Perform a large blind refactor.
* Remove existing functionality.
* Remove settings.
* Rename attributes unnecessarily.
* Change shared code without checking consumers.
* Claim success only because the build passed.

---

# MANDATORY PROJECT RULES

## Existing Functionality

Never remove:

* Existing block functionality
* Existing settings
* Existing attributes
* Existing controls
* Existing responsive behavior
* Existing hover behavior
* Existing motion effects
* Existing dynamic CSS
* Existing frontend functionality

unless explicitly approved.

## Inspector UI

As of the Events-Loop-Builder-inspired redesign, every block's inspector has
exactly one tab row — Blockive's own:

```text
General | Style | Advanced   <- Blockive's own tabs (rendered by <InspectorTabs>)
```

WordPress's own Settings/Styles icon tabs are switched off for every
Blockive block via the `blockInspectorTabs` editor setting
(`Blockive_Premium_Addon_For_Block::bpafb_disable_native_inspector_tabs()`
in `includes/class-bpafb-core.php`). WordPress then lists its own panels —
native color/typography supports, the HTML anchor field — underneath
Blockive's tabs in the same column, so they stay reachable.

This deliberately replaces the plugin's earlier "native Settings/Styles only,
no custom navigation" rule. `<InspectorTabs general={...} style={...}
attributes={...} setAttributes={...} />` (`src/components/inspector-tabs/`)
is the single place this shell lives — every block renders through it, so
changing the shell means changing that one file, not each block. It also
wraps each tab's panels in `<Accordion>` (`src/components/accordion/`) so
only one panel is open at a time; `general`/`style` still work exactly like
plain `PanelBody` lists, the accordion coordinates them automatically.

`AdvancedTab` (`src/components/advanced-tab/`) is no longer a single
component blocks pass in as an `advanced` prop — it's split into
`AdvancedStyleSection` (Spacing/Background/Border/Shadow — how the block
looks, rendered under Style after the block's own style panels) and
`AdvancedSettingsSection` (Layout/Visibility/Z-Index, then
`AdvancedEffectsSection`'s Animation/Transform/Motion Effects, then Custom
Attributes — how it behaves, rendered under Advanced), all consumed directly
by `InspectorTabs`. Blocks only ever pass `general`, `style`, `attributes`,
and `setAttributes`.

**Native supports**: ~21 blocks declare `supports.color` /
`supports.typography` in `block.json`. Most have no equivalent custom
control of their own, so those native panels are their only
text-color/font-size mechanism — don't strip them. With WordPress's own tabs
switched off they appear below Blockive's tabs, not behind a second tab row.
If a block later gets its own equivalent custom controls, its native
supports can be removed then.

When adding a new block, favor the small shared control library
(`SegmentedControl` for 2-4 option choices, `StepperControl` for small
bounded integers, `StyleTilePicker` for visual preset pickers,
`ResponsiveControls`/`ControlRow` for per-device values) over bespoke
`SelectControl`/`RangeControl` usage, so new blocks keep the same feel.

Use normal `PanelBody` panels within `general`/`style` where appropriate.

Do not remove settings simply to simplify the UI.

All existing settings must remain accessible.

## Block Supports

Before changing `block.json` supports:

1. Check for duplicate Blockive functionality.
2. Check attribute dependencies.
3. Check editor behavior.
4. Check frontend behavior.
5. Check shared components.

Do not blindly add or remove Gutenberg supports.

## Attributes

Before changing attributes:

* Search the complete codebase.
* Check editor usage.
* Check save usage.
* Check PHP usage.
* Check dynamic CSS usage.
* Check frontend JavaScript usage.

Do not rename or remove attributes unnecessarily.

## Shared Components

Before modifying a shared component:

1. Find every block using it.
2. Identify all dependencies.
3. Consider regressions.
4. Test all affected blocks.

## Dynamic Blocks

For dynamic blocks, inspect:

* `block.json`
* PHP render callback
* `render.php`
* Query logic
* Escaping
* Sanitization
* Generated HTML
* Generated CSS

## Static Blocks

For static blocks, inspect:

* `edit.js`
* `save.js`
* Attributes
* Generated markup
* Generated classes
* Generated styles

---

# SECURITY RULES

Always use appropriate WordPress security practices.

Check for:

* Input validation
* Sanitization
* Output escaping
* Nonce verification
* Capability checks
* Secure AJAX
* Secure REST API endpoints

Use the appropriate function for the context, including when applicable:

* `sanitize_text_field()`
* `sanitize_key()`
* `absint()`
* `intval()`
* `floatval()`
* `wp_unslash()`
* `wp_kses_post()`
* `esc_html()`
* `esc_attr()`
* `esc_url()`
* `esc_url_raw()`

Do not apply sanitization or escaping blindly.

Choose functions appropriate for the actual data and output context.

---

# CODE QUALITY RULES

Always prefer:

* Clear code
* Reusable components
* Small focused changes
* Existing project patterns
* WordPress APIs
* Gutenberg APIs

Avoid:

* Duplicate code
* Unnecessary abstractions
* Unnecessary dependencies
* Over-engineering
* Large blind refactors
* Unrelated formatting changes

Do not mix large formatting changes with functional fixes.

---

# REQUIRED DEVELOPMENT CYCLE

Every major development cycle must follow:

## Stage 1: Review

Code Reviewer analyzes the relevant code.

## Stage 2: Test

QA Tester tests relevant blocks and templates.

## Stage 3: Prioritize

Team Lead combines and prioritizes findings.

## Stage 4: Fix

Fix Agent implements approved changes.

## Stage 5: Build

Run the relevant project build command.

## Stage 6: Re-Review

Code Reviewer checks the changes.

## Stage 7: Re-Test

QA Tester tests the affected functionality again.

## Stage 8: Approval

Team Lead decides whether the issue is resolved.

---

# DEFINITION OF DONE

An issue is complete only when:

* The root cause is understood.
* The fix is implemented.
* The plugin builds successfully.
* No new relevant errors are introduced.
* Code review passes.
* QA testing passes.
* Editor behavior works.
* Frontend behavior works.
* Responsive behavior works if applicable.
* No regression is detected.
* The Team Lead approves the result.

Build success alone is never sufficient.

---

# REPORTING

Maintain clear reports for:

* Code review findings
* QA testing
* Bug reports
* Prioritized issues
* Fix logs
* Project status

Recommended structure:

```text
docs/
└── ai-team/
    ├── architecture/
    ├── agents/
    ├── reviews/
    ├── tests/
    ├── fixes/
    └── team-lead/
```

The Team Lead should maintain a clear list of:

* Open issues
* Issues in progress
* Issues waiting for testing
* Resolved issues
* Blocked issues

---

# FIRST RULE FOR EVERY TASK

Before changing code:

1. Understand the task.
2. Inspect relevant files.
3. Identify dependencies.
4. Check existing implementation.
5. Check shared components.
6. Check possible regressions.
7. Make the smallest safe change.
8. Build.
9. Test.
10. Report results.

Never perform a large blind refactor.

Never assume existing functionality is unused without verifying it.

Preserve Blockive functionality while improving quality, security, performance, maintainability, and user experience.
