[38;2;131;148;150m   1[0m [38;2;248;248;242mconst fs = require('fs');[0m
[38;2;131;148;150m   2[0m [38;2;248;248;242mlet file = 'resources/views/livewire/tenant/landing/landing-builder.blade.php';[0m
[38;2;131;148;150m   3[0m [38;2;248;248;242mlet content = fs.readFileSync(file, 'utf8');[0m
[38;2;131;148;150m   4[0m 
[38;2;131;148;150m   5[0m [38;2;248;248;242m// Header[0m
[38;2;131;148;150m   6[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m   7[0m [38;2;248;248;242m    /class="flex items-center justify-between px-6 h-14 flex-shrink-0 border-b gap-4 bg-white"\n\s+style="border-color:#e2e8f0;"/g,[0m
[38;2;131;148;150m   8[0m [38;2;248;248;242m    'class="flex items-center justify-between px-6 h-14 flex-shrink-0 border-b border-gray-200 gap-4 bg-white"'[0m
[38;2;131;148;150m   9[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m  10[0m 
[38;2;131;148;150m  11[0m [38;2;248;248;242m// Status Badge[0m
[38;2;131;148;150m  12[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m  13[0m [38;2;248;248;242m    /class="inline-flex items-center gap-1\.5 px-2\.5 py-1 rounded-full text-\[11px\] font-semibold border"\n\s+style="\{\{ \$status === 'published'\n\s+\? 'background:rgba\(34,197,94,0\.1\); color:#86efac; border-color:rgba\(34,197,94,0\.2\)'\n\s+: 'background:rgba\(234,179,8,0\.1\); color:#fde68a; border-color:rgba\(234,179,8,0\.2\)' \}\}"/g,[0m
[38;2;131;148;150m  14[0m [38;2;248;248;242m    `class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-medium {{ $status === 'published' ? 'bg-teal-100 text-teal-800' : 'bg-yellow-100 text-yellow-800' }}"`[0m
[38;2;131;148;150m  15[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m  16[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m  17[0m [38;2;248;248;242m    /<span class="size-1\.5 rounded-full \{\{ \$status === 'published' \? 'animate-pulse' : '' \}\}"\n\s+style="background:\{\{ \$status === 'published' \? '#86efac' : '#fde68a' \}\}"><\/span>/g,[0m
[38;2;131;148;150m  18[0m [38;2;248;248;242m    '<span class="size-1.5 inline-block rounded-full bg-current {{ $status === \'published\' ? \'animate-pulse\' : \'\' }}"></span>'[0m
[38;2;131;148;150m  19[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m  20[0m 
[38;2;131;148;150m  21[0m [38;2;248;248;242m// Buttons[0m
[38;2;131;148;150m  22[0m [38;2;248;248;242m// "Vista previa" topbar[0m
[38;2;131;148;150m  23[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m  24[0m [38;2;248;248;242m    /class="flex items-center gap-1\.5 px-3 py-1\.5 rounded-lg text-xs font-semibold transition-all"\n\s+style="color:#64748b; border:1px solid #e2e8f0; background:white;"\n\s+onmouseover="this\.style\.background='#f1f5f9'; this\.style\.color='#0f172a'"\n\s+onmouseout="this\.style\.background='white'; this\.style\.color='#64748b'"/g,[0m
[38;2;131;148;150m  25[0m [38;2;248;248;242m    'class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"'[0m
[38;2;131;148;150m  26[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m  27[0m 
[38;2;131;148;150m  28[0m [38;2;248;248;242m// "Publicar / Despublicar" topbar[0m
[38;2;131;148;150m  29[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m  30[0m [38;2;248;248;242m    /class="flex items-center gap-1\.5 px-3 py-1\.5 rounded-lg text-xs font-semibold border transition-all"\n\s+style="\{\{ \$status === 'published'\n\s+\? 'background:rgba\(239,68,68,0\.1\); color:#fca5a5; border-color:rgba\(239,68,68,0\.2\)'\n\s+: 'background:rgba\(34,197,94,0\.1\); color:#86efac; border-color:rgba\(34,197,94,0\.2\)' \}\}"/g,[0m
[38;2;131;148;150m  31[0m [38;2;248;248;242m    `class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-white focus:outline-none disabled:opacity-50 disabled:pointer-events-none {{ $status === 'published' ? 'bg-red-500 hover:bg-red-600 focus:bg-red-600' : 'bg-teal-500 hover:bg-teal-600 focus:bg-teal-600' }}"`[0m
[38;2;131;148;150m  32[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m  33[0m 
[38;2;131;148;150m  34[0m [38;2;248;248;242m// Sidebar[0m
[38;2;131;148;150m  35[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m  36[0m [38;2;248;248;242m    /class="w-\[360px\] flex-shrink-0 flex flex-col overflow-hidden"\n\s+style="background:white; border-right:1px solid #e2e8f0"/g,[0m
[38;2;131;148;150m  37[0m [38;2;248;248;242m    'class="w-[360px] flex-shrink-0 flex flex-col overflow-hidden bg-white border-r border-gray-200"'[0m
[38;2;131;148;150m  38[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m  39[0m 
[38;2;131;148;150m  40[0m [38;2;248;248;242m// Tabs in sidebar[0m
[38;2;131;148;150m  41[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m  42[0m [38;2;248;248;242m    /<nav class="flex px-1 gap-0\.5 border-b flex-shrink-0" style="border-color:#e2e8f0; background:white">/g,[0m
[38;2;131;148;150m  43[0m [38;2;248;248;242m    '<nav class="flex px-2 pt-2 gap-2 border-b border-gray-200 flex-shrink-0 bg-white" aria-label="Tabs">'[0m
[38;2;131;148;150m  44[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m  45[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m  46[0m [38;2;248;248;242m    /class="flex-1 py-3 text-xs font-semibold transition-all border-b-2 -mb-px"\n\s+style="\{\{ \$activeTab === \$tab\n\s+\? 'color:#4f46e5; border-color:#4f46e5;'\n\s+: 'color:#64748b; border-color:transparent;' \}\}"/g,[0m
[38;2;131;148;150m  47[0m [38;2;248;248;242m    `class="flex-1 py-3 px-1 text-center font-medium text-sm whitespace-nowrap border-b-2 transition-all hover:text-blue-600 focus:outline-none {{ $activeTab === $tab ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-blue-600' }}"`[0m
[38;2;131;148;150m  48[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m  49[0m 
[38;2;131;148;150m  50[0m [38;2;248;248;242m// Subtitles[0m
[38;2;131;148;150m  51[0m [38;2;248;248;242mcontent = content.replace(/class="text-\[10px\] font-bold uppercase tracking-widest mb-3" style="color:#64748b"/g, 'class="text-xs font-semibold text-gray-500 uppercase mb-3"');[0m
[38;2;131;148;150m  52[0m [38;2;248;248;242mcontent = content.replace(/class="text-\[10px\] font-bold uppercase tracking-widest mb-1" style="color:#64748b"/g, 'class="text-xs font-semibold text-gray-500 uppercase mb-1"');[0m
[38;2;131;148;150m  53[0m [38;2;248;248;242mcontent = content.replace(/class="text-\[10px\] font-bold uppercase tracking-widest mb-2" style="color:#64748b"/g, 'class="text-xs font-semibold text-gray-500 uppercase mb-2"');[0m
[38;2;131;148;150m  54[0m 
[38;2;131;148;150m  55[0m [38;2;248;248;242m// Inputs (Site name)[0m
[38;2;131;148;150m  56[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m  57[0m [38;2;248;248;242m    /class="w-full px-3 py-2 rounded-lg text-sm text-slate-900 placeholder-slate-400 focus:outline-none transition-colors"\n\s+style="background:white; border:1px solid #e2e8f0"/g,[0m
[38;2;131;148;150m  58[0m [38;2;248;248;242m    'class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"'[0m
[38;2;131;148;150m  59[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m  60[0m 
[38;2;131;148;150m  61[0m [38;2;248;248;242m// Add block (Secciones Add)[0m
[38;2;131;148;150m  62[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m  63[0m [38;2;248;248;242m    /class="w-full flex items-center justify-center gap-2 py-2\.5 rounded-xl text-xs font-semibold transition-all"\n\s+style="border:1px dashed #cbd5e1; color:#64748b; background:white"\n\s+onmouseover="this\.style\.borderColor='#4f46e5'; this\.style\.color='#4f46e5'; this\.style\.background='#f5f3ff'"\n\s+onmouseout="this\.style\.borderColor='#cbd5e1'; this\.style\.color='#64748b'; this\.style\.background='white'"/g,[0m
[38;2;131;148;150m  64[0m [38;2;248;248;242m    'class="py-3 px-4 w-full flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-dashed border-gray-300 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none hover:text-blue-600 hover:border-blue-300"'[0m
[38;2;131;148;150m  65[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m  66[0m 
[38;2;131;148;150m  67[0m [38;2;248;248;242m// Edit blocks (Secciones item)[0m
[38;2;131;148;150m  68[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m  69[0m [38;2;248;248;242m    /class="flex items-center gap-1 px-2 py-1 rounded-lg text-\[10px\] font-semibold flex-shrink-0 transition-all"\n\s+style="color:#64748b; background:white; border:1px solid #e2e8f0"\n\s+onmouseover="this\.style\.color='#0f172a'; this\.style\.background='#f8fafc'"\n\s+onmouseout="this\.style\.color='#64748b'; this\.style\.background='white'"/g,[0m
[38;2;131;148;150m  70[0m [38;2;248;248;242m    'class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none shrink-0"'[0m
[38;2;131;148;150m  71[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m  72[0m 
[38;2;131;148;150m  73[0m [38;2;248;248;242m// Viewport buttons [0m
[38;2;131;148;150m  74[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m  75[0m [38;2;248;248;242m    /class="flex p-1 gap-0\.5 rounded-xl" style="background:#f1f5f9; border:1px solid #e2e8f0"/g,[0m
[38;2;131;148;150m  76[0m [38;2;248;248;242m    'class="flex p-1 gap-1 rounded-lg bg-gray-100 border border-gray-200"'[0m
[38;2;131;148;150m  77[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m  78[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m  79[0m [38;2;248;248;242m    /class="flex items-center gap-1\.5 px-3 py-1\.5 rounded-lg text-xs font-semibold transition-all"\n\s+style="\{\{ \$viewport === \$vp\n\s+\? 'background:white; color:#0f172a; box-shadow:0 1px 4px rgba\(0,0,0,0\.3\)'\n\s+: 'color:#475569' \}\}"/g,[0m
[38;2;131;148;150m  80[0m [38;2;248;248;242m    `class="py-1.5 px-3 inline-flex items-center gap-x-2 text-xs font-medium rounded-md focus:outline-none transition-all {{ $viewport === $vp ? 'bg-white text-gray-800 shadow-sm ring-1 ring-gray-200' : 'text-gray-500 hover:text-gray-800' }}"`[0m
[38;2;131;148;150m  81[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m  82[0m 
[38;2;131;148;150m  83[0m [38;2;248;248;242m// Preview Canvas topbar[0m
[38;2;131;148;150m  84[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m  85[0m [38;2;248;248;242m    /class="flex items-center justify-between px-5 py-2\.5 flex-shrink-0"\n\s+style="border-bottom:1px solid #e2e8f0; background:white"/g,[0m
[38;2;131;148;150m  86[0m [38;2;248;248;242m    'class="flex items-center justify-between px-5 py-3 flex-shrink-0 bg-white border-b border-gray-200"'[0m
[38;2;131;148;150m  87[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m  88[0m 
[38;2;131;148;150m  89[0m [38;2;248;248;242m// Icons block settings save[0m
[38;2;131;148;150m  90[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m  91[0m [38;2;248;248;242m    /class="w-full py-2\.5 rounded-xl text-sm font-bold text-white transition-all hover:opacity-90"\n\s+style="background:\{\{ \$colorPrimary \}\}"/g,[0m
[38;2;131;148;150m  92[0m [38;2;248;248;242m    'class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white focus:outline-none disabled:opacity-50 disabled:pointer-events-none transition-all"\n                style="background-color:{{ $colorPrimary }}"\n                onmouseover="this.style.opacity=\'0.9\'" onmouseout="this.style.opacity=\'1\'"'[0m
[38;2;131;148;150m  93[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m  94[0m 
[38;2;131;148;150m  95[0m [38;2;248;248;242m// Save main bottom bar[0m
[38;2;131;148;150m  96[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m  97[0m [38;2;248;248;242m    /class="flex-1 flex items-center justify-center gap-2 py-2\.5 rounded-xl text-sm font-bold text-white transition-all hover:opacity-90 disabled:opacity-50"\n\s+style="background:\{\{ \$colorPrimary \}\}; box-shadow:0 4px 16px \{\{ \$colorPrimary \}\}40"/g,[0m
[38;2;131;148;150m  98[0m [38;2;248;248;242m    'class="flex-1 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white focus:outline-none disabled:opacity-50 disabled:pointer-events-none transition-all"\n                    style="background-color:{{ $colorPrimary }}; box-shadow:0 4px 14px {{ $colorPrimary }}40"\n                    onmouseover="this.style.opacity=\'0.9\'" onmouseout="this.style.opacity=\'1\'"'[0m
[38;2;131;148;150m  99[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m 100[0m 
[38;2;131;148;150m 101[0m [38;2;248;248;242m// Fix color palette picker styles to align with inputs[0m
[38;2;131;148;150m 102[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m 103[0m [38;2;248;248;242m    /class="w-full flex items-center gap-2\.5 px-3 py-2\.5 rounded-xl transition-all"\n\s+style="background:white; border:1px solid #e2e8f0"/g,[0m
[38;2;131;148;150m 104[0m [38;2;248;248;242m    'class="w-full flex items-center justify-between px-3 py-2 border border-gray-200 rounded-lg text-sm bg-white hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500"'[0m
[38;2;131;148;150m 105[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m 106[0m 
[38;2;131;148;150m 107[0m [38;2;248;248;242m// Color palette hex inputs[0m
[38;2;131;148;150m 108[0m [38;2;248;248;242mcontent = content.replace([0m
[38;2;131;148;150m 109[0m [38;2;248;248;242m    /class="font-mono text-\[10px\] px-2 py-1 rounded-lg text-slate-900 focus:outline-none"\n\s+style="width:76px; background:white; border:1px solid #e2e8f0"/g,[0m
[38;2;131;148;150m 110[0m [38;2;248;248;242m    'class="font-mono text-xs px-2 py-1.5 rounded-md text-gray-800 border-gray-200 focus:border-blue-500 focus:ring-blue-500 w-20 bg-white placeholder-gray-400"'[0m
[38;2;131;148;150m 111[0m [38;2;248;248;242m);[0m
[38;2;131;148;150m 112[0m 
[38;2;131;148;150m 113[0m [38;2;248;248;242mfs.writeFileSync(file, content);[0m
[38;2;131;148;150m 114[0m [38;2;248;248;242mconsole.log("Script executed.");[0m
