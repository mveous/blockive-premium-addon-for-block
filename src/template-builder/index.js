import './style.css';
import { registerTemplateEditorStore } from './store';
import registerTemplateSettingsPanel from './template-settings-panel';
import registerDisplayConditionsPanel from './display-conditions-panel';
import registerDynamicContentControl from './dynamic-content-control';
import registerSaveConflictGuard from './save-conflict-guard';
import registerTemplateKindPickerModal from './template-kind-picker-modal';

registerTemplateEditorStore();
registerTemplateSettingsPanel();
registerDisplayConditionsPanel();
registerDynamicContentControl();
registerSaveConflictGuard();
registerTemplateKindPickerModal();
