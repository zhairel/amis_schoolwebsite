@extends('layouts.app')

@section('title', 'Student ID Verification | Al Munawwara Islamic School')

@section('styles')
<style>
    /* Custom Scrollbar for modern feel */
    ::-webkit-scrollbar {
        width: 6px;
    }
    ::-webkit-scrollbar-track {
        background: rgba(2, 44, 34, 0.05);
    }
    ::-webkit-scrollbar-thumb {
        background: rgba(5, 150, 105, 0.3);
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: rgba(5, 150, 105, 0.5);
    }

    /* Glassmorphism utility with hardware acceleration */
    .glass-panel {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.05),
                    inset 0 1px 0 rgba(255, 255, 255, 0.6);
        transform: translateZ(0);
        will-change: transform;
    }

    /* Glow accents using native gradients (removes heavy CPU/GPU blur filter on scroll) */
    .glow-bg-1 {
        background: radial-gradient(circle, rgba(5, 150, 105, 0.18) 0%, rgba(220, 252, 231, 0.04) 50%, rgba(255, 255, 255, 0) 70%);
        transform: translateZ(0);
        will-change: transform;
    }
    .glow-bg-2 {
        background: radial-gradient(circle, rgba(16, 185, 129, 0.14) 0%, rgba(220, 252, 231, 0.02) 40%, rgba(255, 255, 255, 0) 60%);
        transform: translateZ(0);
        will-change: transform;
    }

    /* Holographic overlay shimmer */
    .holo-overlay {
        background: linear-gradient(135deg, 
            rgba(255,255,255,0) 0%, 
            rgba(255,255,255,0) 40%, 
            rgba(255, 255, 255, 0.3) 50%, 
            rgba(255,255,255,0) 60%, 
            rgba(255,255,255,0) 100%
        );
        background-size: 250% 250%;
        background-position: 0% 0%;
        transition: background-position 0.6s ease;
    }
    .holo-card:hover .holo-overlay {
        background-position: 100% 100%;
    }

    /* 3D Card Flip styling */
    .perspective-1000 {
        perspective: 1200px;
        -webkit-perspective: 1200px;
    }
    .card-inner {
        transform-style: preserve-3d;
        -webkit-transform-style: preserve-3d;
        transition: transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .card-front, .card-back {
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 24px;
    }
    .card-front {
        transform: rotateY(0deg);
        -webkit-transform: rotateY(0deg);
        z-index: 2;
    }
    .card-back {
        transform: rotateY(180deg);
        -webkit-transform: rotateY(180deg);
        z-index: 1;
    }
    .is-flipped {
        transform: rotateY(180deg);
    }

    /* Custom checkbox & input glow focus */
    .input-focus-glow:focus {
        border-color: rgba(5, 150, 105, 0.8) !important;
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.15) !important;
    }

    /* Draw animation for SVG checkmark */
    .svg-success-path {
        stroke-dasharray: 100;
        stroke-dashoffset: 100;
        animation: drawCheck 0.6s ease-out forwards 0.2s;
    }
    .svg-success-circle {
        stroke-dasharray: 150;
        stroke-dashoffset: 150;
        animation: drawCircle 0.6s ease-out forwards;
    }

    @keyframes drawCheck {
        to { stroke-dashoffset: 0; }
    }
    @keyframes drawCircle {
        to { stroke-dashoffset: 0; }
    }

    /* Local Tailwind Utility Mappings */
    .w-full { width: 100%; }
    .max-w-6xl { max-width: 72rem; }
    .max-w-sm { max-width: 24rem; }
    .mx-auto { margin-left: auto; margin-right: auto; }
    .grid { display: grid; }
    .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
    .gap-8 { gap: 2rem; }
    .gap-4 { gap: 1rem; }
    .gap-3 { gap: 0.75rem; }
    .gap-2 { gap: 0.5rem; }
    .gap-6 { gap: 1.5rem; }
    .items-start { align-items: flex-start; }
    .items-center { align-items: center; }
    .items-end { align-items: flex-end; }
    .justify-between { justify-content: space-between; }
    .justify-center { justify-content: center; }
    .flex { display: flex; }
    .flex-col { flex-direction: column; }
    .flex-grow { flex-grow: 1; }
    .flex-shrink-0 { flex-shrink: 0; }

    @media (min-width: 1024px) {
        .lg:grid-cols-12 { grid-template-columns: repeat(12, minmax(0, 1fr)); }
        .lg:col-span-6 { grid-column: span 6 / span 6; }
    }
    @media (min-width: 640px) {
        .sm:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .sm:p-8 { padding: 2rem; }
    }

    .relative { position: relative; }
    .absolute { position: absolute; }
    .inset-0 { top: 0; right: 0; bottom: 0; left: 0; }
    .inset-y-0 { top: 0; bottom: 0; }
    .right-0 { right: 0; }
    .pointer-events-none { pointer-events: none; }

    .py-16 { padding-top: 4rem; padding-bottom: 4rem; }
    .px-4 { padding-left: 1rem; padding-right: 1rem; }
    .p-6 { padding: 1.5rem; }
    .p-5 { padding: 1.25rem; }
    .p-4 { padding: 1rem; }
    .p-2.5 { padding: 0.625rem; }
    .p-1 { padding: 0.25rem; }
    .px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
    .py-4 { padding-top: 1rem; padding-bottom: 1rem; }
    .px-2 { padding-left: 0.5rem; padding-right: 0.5rem; }
    .pr-4 { padding-right: 1rem; }
    
    .mb-6 { margin-bottom: 1.5rem; }
    .mb-2 { margin-bottom: 0.5rem; }
    .mb-3 { margin-bottom: 0.75rem; }
    .mb-1.5 { margin-bottom: 0.375rem; }
    .mb-0.5 { margin-bottom: 0.125rem; }
    .mt-8 { margin-top: 2rem; }
    .mt-4 { margin-top: 1rem; }
    .mt-3 { margin-top: 0.75rem; }
    .mt-0.5 { margin-top: 0.125rem; }
    .my-4 { margin-top: 1rem; margin-bottom: 1rem; }
    .pt-6 { padding-top: 2rem; }
    .pt-4 { padding-top: 1rem; }
    .pt-2.5 { padding-top: 0.625rem; }
    .pb-3 { padding-bottom: 0.75rem; }
    
    .h-16 { height: 4rem; }
    .w-16 { width: 4rem; }
    .h-12 { height: 3rem; }
    .w-12 { width: 3rem; }
    .h-10 { height: 2.5rem; }
    .w-10 { width: 2.5rem; }
    .h-20 { height: 5rem; }
    .w-20 { width: 5rem; }
    .h-2 { height: 0.5rem; }
    .w-2 { width: 0.5rem; }
    
    .h-\[140px\] { height: 140px; }
    .w-\[140px\] { width: 140px; }
    .w-\[340px\] { width: 340px; }
    .h-\[520px\] { height: 520px; }

    .text-2xl { font-size: 1.5rem; }
    .text-3xl { font-size: 1.875rem; }
    .text-lg { font-size: 1.125rem; }
    .text-sm { font-size: 0.875rem; }
    .text-xs { font-size: 0.75rem; }
    .text-white { color: #ffffff; }
    .text-slate-800 { color: #1e293b; }
    .text-slate-600 { color: #475569; }
    .text-slate-500 { color: #64748b; }
    .text-slate-400 { color: #94a3b8; }
    .text-emerald-700 { color: #047857; }
    .text-emerald-600 { color: #059669; }
    .text-emerald-300 { color: #6ee7b7; }
    .text-emerald-400\/40 { color: rgba(52, 211, 153, 0.4); }
    .text-rose-700 { color: #be123c; }
    .text-rose-500 { color: #f43f5e; }
    
    .font-extrabold { font-weight: 800; }
    .font-bold { font-weight: 700; }
    .font-semibold { font-weight: 600; }
    .font-medium { font-weight: 500; }
    .uppercase { text-transform: uppercase; }
    .lowercase { text-transform: lowercase; }
    .tracking-wider { letter-spacing: 0.05em; }
    .tracking-wide { letter-spacing: 0.025em; }
    .tracking-tight { letter-spacing: -0.025em; }
    .tracking-widest { letter-spacing: 0.1em; }
    
    .text-center { text-align: center; }
    .text-left { text-align: left; }
    .leading-relaxed { line-height: 1.625; }
    .leading-tight { line-height: 1.25; }
    .truncate { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

    .border { border: 1px solid #e2e8f0; }
    .border-t { border-top: 1px solid #e2e8f0; }
    .border-b { border-bottom: 1px solid #e2e8f0; }
    .border-slate-200 { border-color: #e2e8f0; }
    .border-emerald-200 { border-color: #a7f3d0; }
    .border-emerald-500\/20 { border-color: rgba(16, 185, 129, 0.2); }
    .border-emerald-500\/30 { border-color: rgba(16, 185, 129, 0.3); }
    .border-emerald-600\/30 { border-color: rgba(5, 150, 105, 0.3); }
    .border-slate-700\/50 { border-color: rgba(51, 65, 85, 0.5); }
    .border-slate-700\/60 { border-color: rgba(51, 65, 85, 0.6); }
    .border-slate-800 { border-color: #1e293b; }
    .border-white\/20 { border-color: rgba(255, 255, 255, 0.2); }
    .border-3 { border-width: 3px; }
    .border-emerald-400\/40 { border-color: rgba(52, 211, 153, 0.4); }
    
    .rounded-2xl { border-radius: 1rem; }
    .rounded-3xl { border-radius: 1.5rem; }
    .rounded-full { border-radius: 9999px; }
    .rounded-xl { border-radius: 0.75rem; }
    .rounded-lg { border-radius: 0.5rem; }
    .rounded-md { border-radius: 0.375rem; }
    
    .bg-emerald-50 { background-color: #ecfdf5; }
    .bg-emerald-600 { background-color: #059669; }
    .bg-emerald-700 { background-color: #047857; }
    .bg-rose-50 { background-color: #fff1f2; }
    .bg-slate-50\/50 { background-color: rgba(248, 250, 252, 0.5); }
    .bg-white { background-color: #ffffff; }
    .bg-slate-900\/50 { background-color: rgba(15, 23, 42, 0.5); }
    .bg-slate-900\/40 { background-color: rgba(15, 23, 42, 0.4); }
    .bg-slate-900 { background-color: #0f172a; }
    .bg-white\/10 { background-color: rgba(255, 255, 255, 0.1); }
    
    .bg-gradient-to-br { background-image: linear-gradient(135deg, var(--tw-gradient-stops)); }
    .from-emerald-800 { --tw-gradient-from: #065f46; --tw-gradient-to: rgba(6, 95, 70, 0); --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to); }
    .via-emerald-700 { --tw-gradient-to: rgba(4, 120, 87, 0); --tw-gradient-stops: var(--tw-gradient-from), #047857, var(--tw-gradient-to); }
    .to-teal-900 { --tw-gradient-to: #115e59; }
    .from-slate-900 { --tw-gradient-from: #0f172a; --tw-gradient-to: rgba(15, 23, 42, 0); --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to); }
    .to-slate-800 { --tw-gradient-to: #1e293b; }
    .from-cyan-400 { --tw-gradient-from: #22d3ee; --tw-gradient-stops: var(--tw-gradient-from), rgba(34, 211, 238, 0); }
    .via-pink-400 { --tw-gradient-stops: var(--tw-gradient-from), #f472b6, rgba(244, 114, 182, 0); }
    .to-yellow-300 { --tw-gradient-to: #fde047; }
    
    .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
    .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); }
    .shadow-md { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
    .shadow-inner { box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06); }

    .opacity-30 { opacity: 0.3; }
    .opacity-60 { opacity: 0.6; }
    .opacity-75 { opacity: 0.75; }
    .opacity-85 { opacity: 0.85; }
    .mix-blend-overlay { mix-blend-mode: overlay; }
    .mix-blend-screen { mix-blend-mode: screen; }
    .overflow-hidden { overflow: hidden; }
    
    .animate-spin { animation: spin 1s linear infinite; }
    @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    .animate-pulse { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
    @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: .5; } }
    
    .block { display: block; }
    .inline-block { display: inline-block; }
    .inline-flex { display: inline-flex; }
    
    .space-y-5 > * + * { margin-top: 1.25rem; }
    .space-y-4 > * + * { margin-top: 1rem; }
    .appearance-none { -webkit-appearance: none; -moz-appearance: none; appearance: none; }
    .cursor-pointer { cursor: pointer; }
    .object-cover { object-fit: cover; }
    
    /* Input adjustments */
    input, select {
        outline: none;
        box-shadow: none;
        box-sizing: border-box;
    }
    input:focus, select:focus {
        border-color: #059669;
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.15);
    }

    .py-3\.5 {
        padding-top: 0.875rem !important;
        padding-bottom: 0.875rem !important;
    }
    .px-4 {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
    }
    .w-full {
        width: 100% !important;
    }

    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 200ms;
    }

    /* Style the select element to display a beautiful dropdown arrow with appearance-none */
    select {
        background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E") !important;
        background-position: right 1rem center !important;
        background-repeat: no-repeat !important;
        background-size: 1.25em auto !important;
        padding-right: 2.5rem !important;
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        appearance: none !important;
    }

    /* Force proper font stacks */
    input, select, button, label, span, p, div {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
    }
    h2, h3, h4, h5, h6, .font-extrabold {
        font-family: 'Outfit', sans-serif !important;
    }

    /* Preview Container Layout Grid */
    .preview-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 2rem;
        width: 100%;
        margin-top: 0.5rem;
    }
    .preview-left-col {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        width: 100%;
        max-width: 340px;
    }
    .preview-right-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1.5rem;
        width: 100%;
    }
    @media (min-width: 768px) {
        .preview-right-col {
            flex-direction: row;
            justify-content: center;
            align-items: center;
            max-width: 710px;
            gap: 1.5rem;
        }
    }
    .preview-container.is-fullscreen {
        position: fixed !important;
        inset: 0 !important;
        background-color: #022c22 !important;
        background-image: radial-gradient(circle at 50% 50%, #064e3b 0%, #022c22 100%) !important;
        z-index: 99999 !important;
        width: 100vw !important;
        height: 100vh !important;
        max-width: 100% !important;
        margin: 0 !important;
        padding: 2rem !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        overflow-y: auto !important;
        backdrop-filter: blur(16px) !important;
        -webkit-backdrop-filter: blur(16px) !important;
    }
</style>
@endsection

@section('content')
@if(request()->boolean('embed'))
<style>.header,.footer{display:none!important}body{background:#f8fafc!important}</style>
@endif
<div class="relative min-h-[920px] pt-12 pb-32 sm:pt-16 sm:pb-40 px-6 bg-slate-50 overflow-hidden flex flex-col justify-center items-center"
     x-data="{
         student_id: @js((string) request()->query('student_id', '')),
         full_name: @js((string) request()->query('full_name', '')),
         school_year: @js((string) request()->query('school_year', '2026-2027')),
         autoShow: @js(request()->boolean('auto')),
         loading: false,
         errorMsg: '',
         success: false,
         result: null,
          flipFront: false,
          flipBack: false,
           isFullScreen: false,
           showIdCard: false,
           showCorrectionRequest: false,
           
           init() {
               this.$watch('isFullScreen', value => {
                   const header = document.querySelector('.header');
                   const footer = document.querySelector('.footer');
                   if (value) {
                       if (header) header.style.setProperty('display', 'none', 'important');
                       if (footer) footer.style.setProperty('display', 'none', 'important');
                       document.body.style.overflow = 'hidden';
                   } else {
                       if (header) header.style.removeProperty('display');
                       if (footer) footer.style.removeProperty('display');
                       document.body.style.overflow = '';
                   }
               });
               if (this.autoShow && this.student_id && this.full_name && this.school_year) {
                   this.$nextTick(() => this.submitVerification());
               }
           },
         
         getGradeColor(grade) {
             if (!grade) return '#6d28d9';
             const g = grade.toUpperCase();
             if (g.includes('NURSERY') || g.includes('KINDER') || g.includes('PRE-')) return '#ea580c'; // Premium Coral/Orange
             if (g.includes('GRADE 1') || g.includes('GRADE 2') || g.includes('GRADE 3')) return '#0284c7'; // Sky/Ocean Blue
             if (g.includes('GRADE 4') || g.includes('GRADE 5') || g.includes('GRADE 6')) return '#7c3aed'; // Bright Purple
             if (g.includes('GRADE 7') || g.includes('GRADE 8') || g.includes('GRADE 9') || g.includes('GRADE 10')) return '#dc2626'; // Deep Crimson Red
             if (g.includes('GRADE 11') || g.includes('GRADE 12') || g.includes('GRADE XI') || g.includes('GRADE XII')) return '#4f46e5'; // Royal Indigo
             return '#6d28d9'; // Default violet
         },
         
         isEmergencyMissing() {
             if (!this.result) return false;
             return this.isParentMissing() || this.isAddressMissing();
         },
         
         isParentMissing() {
             if (!this.result) return false;
             const parent = (this.result.parent_name || '').toUpperCase().trim();
             const contact = (this.result.contact_no || '').replaceAll(' ', '').trim();
             return parent === '' || 
                    parent === 'REGISTRAR OFFICE' || 
                    contact === '' || 
                    contact === '+639000000000';
         },
         
         isAddressMissing() {
             if (!this.result) return false;
             const address = (this.result.address || '').toUpperCase().trim();
             return address === '' || address === 'DAVAO CITY, PHILIPPINES';
         },
         
         submitVerification() {
             if (!this.student_id || !this.full_name || !this.school_year) {
                 this.errorMsg = 'All fields are required.';
                 return;
             }
             
             this.loading = true;
             this.errorMsg = '';
             this.success = false;
             this.result = null;
             this.isFlipped = false;
             this.showIdCard = false;
             this.showCorrectionRequest = false;
             
             fetch('{{ route('id-verification.verify') }}', {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                 },
                 body: JSON.stringify({
                     student_id: this.student_id,
                     full_name: this.full_name,
                     school_year: this.school_year
                 })
             })
             .then(async response => {
                 const data = await response.json();
                 this.loading = false;
                 if (response.ok && data.success) {
                     this.result = data;
                     this.success = true;
                     if (this.autoShow) this.showIdCard = true;
                 } else {
                     this.errorMsg = data.message || 'An error occurred during verification.';
                 }
             })
             .catch(err => {
                 this.loading = false;
                 this.errorMsg = 'Unable to connect. Please check your internet connection.';
             });
         },
         
          toggleFlipAll() {
              this.flipFront = !this.flipFront;
              this.flipBack = !this.flipBack;
          },
          
          async downloadCard(format) {
              // 1. Download Front Card
              const frontEl = document.getElementById('id-card-front');
              if (frontEl) {
                  await this.generateAndDownload(frontEl, 'Front', format);
              }
              
              // 2. Download Back Card
              const backEl = document.getElementById('id-card-back');
              if (backEl) {
                  setTimeout(async () => {
                      await this.generateAndDownload(backEl, 'Back', format);
                  }, 400);
              }
          },

          async generateAndDownload(element, suffix, format) {
              try {
                  const originalShadow = element.style.boxShadow;
                  element.style.boxShadow = 'none';
                  
                  const canvas = await html2canvas(element, {
                      scale: 3,
                      useCORS: true,
                      allowTaint: false,
                      backgroundColor: null,
                      logging: false
                  });
                  
                  element.style.boxShadow = originalShadow;
                  
                  const fileName = `AMIS_ID_${this.result.student_id}_${suffix}`;
                  
                  if (format === 'png') {
                      const link = document.createElement('a');
                      link.download = `${fileName}.png`;
                      link.href = canvas.toDataURL('image/png');
                      link.click();
                  } else if (format === 'jpeg') {
                      const link = document.createElement('a');
                      link.download = `${fileName}.jpg`;
                      link.href = canvas.toDataURL('image/jpeg', 0.95);
                      link.click();
                  }
              } catch (e) {
                  console.error('Download error:', e);
                  alert(`Failed to generate ${suffix} card image. Please try again.`);
              }
          }
      }">

    <!-- Radial glow spots in background -->
    <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] glow-bg-1 pointer-events-none rounded-full"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] glow-bg-2 pointer-events-none rounded-full"></div>

    <div class="w-full mx-auto relative z-10 flex flex-col justify-center items-center transition-all duration-300" :style="showIdCard ? 'max-width: 1100px;' : 'max-width: 520px;'">
        
        <!-- STEP 1: Verification Form -->
        <div x-show="!success && !loading" class="w-full bg-white glass-panel rounded-3xl p-6 sm:p-8 shadow-xl transition-all duration-300"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            
            <div class="mb-6 text-center">
                <span class="inline-block px-3.5 py-1 bg-emerald-50 text-emerald-700 font-black text-xs rounded-full uppercase tracking-widest mb-3">
                    ID Verification Portal
                </span>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Verify Student ID Card</h2>
                <p class="text-slate-500 text-sm mt-1.5 leading-relaxed">
                    Ensure authenticity of AMIS IDs or temporary registration credentials.
                </p>
            </div>

            <!-- Error Alert box -->
            <div x-show="errorMsg" x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="mb-6 px-4 py-3 bg-rose-50 border border-rose-100 text-rose-700 rounded-2xl text-sm flex items-start gap-3 shadow-sm" x-cloak>
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span x-text="errorMsg" class="font-medium leading-relaxed"></span>
            </div>

            <!-- Verification Form -->
            <form @submit.prevent="submitVerification()" class="space-y-5 mb-8">
                <div>
                    <label for="student_id" class="block text-[13px] font-black text-slate-700 uppercase tracking-wider mb-2">Student ID or Temporary ID</label>
                    <div class="relative">
                        <input type="text" id="student_id" x-model="student_id" placeholder="AMIS-2026-000123 or TEMP-2026-000123" required
                               class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-3.5 text-slate-900 placeholder-slate-400 font-bold text-base input-focus-glow transition-all duration-200">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="full_name" class="block text-[13px] font-black text-slate-700 uppercase tracking-wider mb-2">Student Full Name</label>
                    <div class="relative">
                        <input type="text" id="full_name" x-model="full_name" @input="full_name = full_name.toUpperCase()" placeholder="First Name Last Name" required
                               class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-3.5 text-slate-900 placeholder-slate-400 font-bold text-base uppercase input-focus-glow transition-all duration-200">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="school_year" class="block text-[13px] font-black text-slate-700 uppercase tracking-wider mb-2">School Year</label>
                    <select id="school_year" x-model="school_year" required
                            class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-3.5 text-slate-900 font-bold text-base input-focus-glow transition-all duration-200">
                        <option value="2026-2027" selected>2026-2027</option>
                    </select>
                </div>

                <button type="submit" :disabled="loading"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 px-6 rounded-2xl shadow-lg hover:shadow-emerald-600/20 active:scale-[0.98] transition-all duration-150 flex items-center justify-center gap-2 cursor-pointer disabled:opacity-75 disabled:cursor-wait">
                    <span>Submit Verification</span>
                </button>
            </form>

            <!-- Separate Registration CTA -->
            <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col items-center justify-center text-center">
                <p class="text-sm text-slate-500 mb-1.5">Don't have an AMIS ID yet?</p>
                <a href="https://enrollment.amis.edu.ph/register"
                   class="text-emerald-600 hover:text-emerald-700 font-bold text-sm hover:underline transition-colors duration-150">
                    Proceed to Register
                </a>
            </div>
        </div>

        <!-- STEP 2: Spinner / Loading State -->
        <div x-show="loading" class="w-full bg-white glass-panel rounded-3xl p-8 shadow-xl text-center flex flex-col items-center justify-center min-h-[300px]" x-cloak>
            <div class="relative w-16 h-16">
                <div class="absolute inset-0 rounded-full border-4 border-emerald-100"></div>
                <div class="absolute inset-0 rounded-full border-4 border-emerald-600 border-t-transparent animate-spin"></div>
            </div>
            <span class="text-slate-400 font-bold text-xs mt-6 uppercase tracking-widest animate-pulse">Running Verification...</span>
        </div>

        <!-- STEP 3: Spelling Confirmation Screen -->
        <div x-show="success && result && !showIdCard && !showCorrectionRequest" class="w-full bg-white glass-panel rounded-3xl p-6 sm:p-8 shadow-xl text-center relative overflow-hidden"
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            
            <!-- Back Icon (returns to Form) -->
            <button @click="success = false; result = null;" 
                    class="absolute top-4 left-4 text-slate-400 hover:text-slate-600 transition-colors p-1.5 rounded-lg hover:bg-slate-50 cursor-pointer"
                    title="Go Back">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </button>

            <div class="h-14 w-14 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto mb-4 mt-2">
                <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
            
            <h3 class="text-2xl font-black text-slate-900 uppercase tracking-wide">Is this correct??</h3>
            <p class="text-slate-500 text-sm mt-2 leading-relaxed px-4">
                Please double check if your Name, Student ID, and LRN spelling are correct as registered:
            </p>

            <!-- Details Box -->
            <div class="mt-5 bg-slate-50 border border-slate-100 rounded-2xl p-5 text-left space-y-4">
                <div>
                    <span class="text-[10px] uppercase tracking-widest text-slate-400 font-black block mb-0.5">AMIS Student ID</span>
                    <span class="text-base font-black text-slate-900" x-text="result?.student_id"></span>
                </div>
                <div class="border-t border-slate-200/50 pt-3">
                    <span class="text-[10px] uppercase tracking-widest text-slate-400 font-black block mb-0.5">Student Full Name</span>
                    <span class="text-base font-black text-slate-900" x-text="result?.full_name"></span>
                </div>
                <div class="border-t border-slate-200/50 pt-3">
                    <span class="text-[10px] uppercase tracking-widest text-slate-400 font-black block mb-0.5">LRN (Learner Reference Number)</span>
                    <span class="text-base font-black text-slate-900" x-text="result?.lrn"></span>
                </div>
                <div class="border-t border-slate-200/50 pt-3">
                    <span class="text-[10px] uppercase tracking-widest text-slate-400 font-black block mb-0.5">Grade Level</span>
                    <span class="text-base font-black text-slate-900" x-text="result?.grade_level"></span>
                </div>
            </div>

            <div class="mt-6 flex flex-col sm:flex-row gap-3">
                <!-- Yes, Display ID Card -->
                <button @click="showIdCard = true"
                        class="flex-grow py-4 px-5 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-sm rounded-xl transition-all duration-200 shadow-md cursor-pointer uppercase tracking-wider">
                    Yes, Show Display
                </button>
                <!-- No, typo correction -->
                <button @click="showCorrectionRequest = true"
                        class="py-4 px-5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-black text-sm rounded-xl transition-all duration-200 cursor-pointer uppercase tracking-wider">
                    No, Correct it
                </button>
            </div>
        </div>

        <!-- STEP 4: Correction Request Screen -->
        <div x-show="success && result && showCorrectionRequest" class="w-full bg-white glass-panel rounded-3xl p-6 sm:p-8 shadow-xl text-center relative overflow-hidden"
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            
            <!-- Back Icon (returns to Confirmation) -->
            <button @click="showCorrectionRequest = false;" 
                    class="absolute top-4 left-4 text-slate-400 hover:text-slate-600 transition-colors p-1.5 rounded-lg hover:bg-slate-50 cursor-pointer"
                    title="Go Back">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </button>

            <div class="h-14 w-14 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center mx-auto mb-4 mt-2">
                <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            
            <h3 class="text-xl font-extrabold text-slate-800 uppercase tracking-wide">Typo Correction</h3>
            <p class="text-slate-500 text-xs mt-2 leading-relaxed px-4">
                Database records are locked for security. To update the spelling of your name or LRN, contact:
            </p>

            <div class="mt-5 bg-amber-50/50 border border-amber-100 text-amber-800 text-xs p-4 rounded-xl leading-relaxed text-left">
                Please notify the registrar's office to update your official records:
                <ul class="list-disc list-inside mt-2 space-y-1.5 font-bold">
                    <li>Email: <a href="mailto:registrar@amis.edu.ph" class="underline">registrar@amis.edu.ph</a></li>
                    <li>SMS/Call: +63 927 299 1833</li>
                    <li>Provide Student ID & PSA birth cert copy</li>
                </ul>
            </div>

            <div class="mt-6">
                <button @click="showCorrectionRequest = false"
                        class="w-full py-3.5 px-4 bg-slate-800 hover:bg-slate-900 text-white font-extrabold text-xs rounded-xl transition-all duration-200 cursor-pointer uppercase tracking-wider">
                    Go Back
                </button>
            </div>
        </div>

        <!-- STEP 5: Final ID Preview Display -->
        <div x-show="success && result && showIdCard" class="w-full flex flex-col items-center gap-5 relative" x-cloak
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0">
            


            <!-- F2F Display State (Canva Embed) -->
            <div x-show="result?.is_f2f" class="w-full max-w-md p-6 bg-white glass-panel rounded-3xl text-center shadow-lg relative overflow-hidden">
                <div class="bg-amber-50 border border-amber-100 text-amber-800 font-bold px-4 py-3 rounded-2xl text-xs uppercase tracking-widest inline-block mb-4 animate-pulse">
                    ⚠️ ID Under Processing / Coming Soon
                </div>
                <h3 class="text-lg font-black text-slate-800">Face-to-Face ID Template</h3>
                <p class="text-slate-400 text-xs mt-1 leading-relaxed max-w-xs mx-auto">
                    Official Face-to-Face digital and physical IDs are currently under processing. Below is a preview of the official design layout.
                </p>

                <!-- Canva Embed Code -->
                <div class="w-full relative rounded-2xl overflow-hidden shadow-inner border border-slate-100 bg-slate-100 mt-5"
                     style="padding-top: 158.5185%; position: relative; height: 0; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16); will-change: transform;">
                    <iframe loading="lazy" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0; margin: 0;"
                      src="https://www.canva.com/design/DAHOM9sgZSc/Rg4LW-91PvsgHA2i-VPM3w/view?embed" allowfullscreen="allowfullscreen" allow="fullscreen">
                    </iframe>
                </div>
                
                <div class="mt-4 text-center">
                    <a href="https://www.canva.com/design/DAHOM9sgZSc/Rg4LW-91PvsgHA2i-VPM3w/view" target="_blank" rel="noopener"
                       class="text-[10px] font-black text-emerald-700 hover:text-emerald-800 uppercase tracking-widest flex items-center justify-center gap-1">
                        <span>Open Design on Canva</span>
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <line x1="10" y1="14" x2="21" y2="3"></line>
                        </svg>
                    </a>
                </div>
            </div>

            <div x-show="!result?.is_f2f" class="preview-container" :class="isFullScreen ? 'is-fullscreen' : ''">
                
                <!-- Floating Header Actions in Full Screen -->
                <div x-show="isFullScreen" x-cloak class="w-full max-w-[800px] flex justify-between items-center mb-6 text-white animate-fade-in" style="font-family: 'Outfit', sans-serif;">
                    <h2 class="text-base sm:text-lg font-bold tracking-wide">AMIS ID Card Preview <span class="text-xs sm:text-sm font-bold text-emerald-400 ml-2 animate-pulse">(Please screenshot it)</span></h2>
                    <div class="flex items-center gap-3">
                        <!-- Close fullscreen -->
                        <button @click="isFullScreen = false"
                                class="bg-slate-800 hover:bg-slate-700 active:scale-[0.98] text-white p-2.5 rounded-xl transition-all duration-150 cursor-pointer">
                            <svg class="w-4 h-4 sm:w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                </div>



                <!-- RIGHT COLUMN: ID Card Preview -->
                <div class="preview-right-col" :class="isFullScreen ? 'w-full max-w-[800px] flex flex-col md:flex-row gap-6 justify-center items-center' : ''">
                    
                    <!-- FRONT CARD CONTAINER -->
                    <div class="perspective-1000 w-[340px] h-[538px] cursor-pointer"
                         @click="flipFront = !flipFront" style="width: 340px; height: 538px; border-radius: 24px; position: relative;">
                        
                        <div class="card-inner w-full h-full relative"
                             :class="flipFront ? 'is-flipped' : ''" style="width: 100%; height: 100%;">
                            
                            <!-- Front Face of Front Card (Default) -->
                            <div id="id-card-front" class="card-front absolute inset-0 w-full h-full rounded-[24px]" 
                                 style="width: 340px; height: 538px; position: absolute; left: 0; top: 0;">
                                
                                <!-- Background Template Image -->
                                <img src="{{ asset('assets/amis-id-template.png') }}?v=3" crossorigin="anonymous" class="id-template absolute inset-0 w-full h-full object-cover pointer-events-none" style="z-index: 1; border-radius: 24px;" alt="AMIS ID Template">

                                <!-- Student Photo Overlay -->
                                <img x-show="result?.photo_url && !result.photo_url.includes('default-avatar')"
                                     :src="result?.photo_url" 
                                     crossorigin="anonymous"
                                     class="student-photo absolute" 
                                     style="left: 81px; top: 114px; width: 178px; height: 172px; overflow: hidden; border-radius: 14px; z-index: 10; object-fit: cover;"
                                     alt="Student Photo">

                                <!-- Yellow Photo Warning Stamp (Anti-edit) -->
                                <div x-show="!result?.photo_url || result.photo_url.includes('default-avatar')"
                                     class="absolute flex flex-col items-center justify-center text-center p-3" 
                                     style="left: 81px; top: 114px; width: 178px; height: 172px; z-index: 10; border-radius: 14px; background: #fef08a; border: 2.5px dashed #ca8a04; box-sizing: border-box;">
                                    <svg class="w-6 h-6 text-amber-600 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <span class="font-black text-amber-950 text-[10.5px] uppercase leading-tight" style="font-family: 'Outfit', sans-serif;">Warning</span>
                                    <span class="font-extrabold text-amber-900 text-[8.5px] mt-0.5 uppercase leading-tight" style="font-family: 'Outfit', sans-serif;">Incomplete ID Data</span>
                                    <span class="font-bold text-amber-800 text-[8px] mt-1.5 leading-normal" style="font-family: 'Outfit', sans-serif;">Photo is missing.<br>Please re-upload.</span>
                                </div>

                                <!-- Student ID Badge text overlay (No background color, centered transparent overlay on new blank template) -->
                                <div class="student-id absolute text-center flex items-center justify-center font-black tracking-wider text-[12.5px] text-white" 
                                     style="left: 121px; top: 295px; width: 95px; height: 15px; z-index: 10; background: transparent; line-height: 1;"
                                     x-text="result ? (result.student_id.startsWith('AMIS-') ? result.student_id.split('-')[1].substring(2,4) + parseInt(result.student_id.split('-')[2]).toString().padStart(4,'0') : result.student_id) : ''"></div>

                                <!-- Last Name Text Overlay -->
                                <div class="student-last-name absolute text-center flex flex-col justify-center px-4" 
                                     style="left: 15px; top: 334px; width: 310px; height: 32px; z-index: 10;">
                                    <h3 class="font-black uppercase text-slate-900 animate-fade-in" 
                                        style="font-family: 'Outfit', sans-serif; line-height: 1; letter-spacing: -0.5px;"
                                        x-bind:style="result?.last_name?.length > 20 ? 'font-size: 16px;' : (result?.last_name?.length > 15 ? 'font-size: 19px;' : (result?.last_name?.length > 10 ? 'font-size: 23px;' : 'font-size: 26px;'))"
                                        x-text="result?.last_name"></h3>
                                </div>

                                <!-- First Name / Middle Name Text Overlay -->
                                <div class="student-first-name absolute text-center flex flex-col justify-center px-4" 
                                     style="left: 15px; top: 366px; width: 310px; height: 22px; z-index: 10;">
                                    <h4 class="font-bold uppercase text-slate-700" 
                                        style="font-family: 'Outfit', sans-serif; line-height: 1;"
                                        x-bind:style="result?.first_name?.length > 25 ? 'font-size: 11px;' : (result?.first_name?.length > 18 ? 'font-size: 13px;' : 'font-size: 15px;')"
                                        x-text="result?.first_name"></h4>
                                </div>

                                <!-- Grade Level Text Overlay -->
                                <div class="student-grade absolute text-center flex flex-col justify-center px-4" 
                                     style="left: 15px; top: 406px; width: 310px; height: 30px; z-index: 10;">
                                    <span class="font-extrabold uppercase" 
                                          :style="'color: ' + getGradeColor(result?.grade_level)"
                                          style="font-family: 'Outfit', sans-serif; font-size: 26px; font-weight: 900; line-height: 1; letter-spacing: 0.5px; text-shadow: 0 1px 1px rgba(0,0,0,0.05);"
                                          x-text="result?.grade_level"></span>
                                </div>

                                <!-- LRN Overlay (Rotated 90deg, aligned to the right blank side, matching SY style on left) -->
                                <div x-show="result?.lrn && result.lrn !== 'N/A' && result.lrn !== 'NA' && result.lrn !== 'EMPTY' && result.lrn !== ''"
                                     class="absolute text-slate-800 font-bold" 
                                     style="font-family: 'Outfit', sans-serif; font-size: 15.5px; z-index: 10; right: 8px; top: 405px; width: 22px; height: 130px; display: flex; align-items: center; justify-content: center; transform: rotate(-90deg); transform-origin: center; white-space: nowrap; letter-spacing: 0.05em;">
                                    LRN: <span x-text="result?.lrn" style="margin-left: 4px;"></span>
                                </div>

                                <!-- QR Code Overlay (Aligned perfectly inside the template green square border) -->
                                <div class="student-qr absolute bg-white" style="left: 134.5px; top: 458px; width: 71px; height: 71px; z-index: 10; padding: 2.5px; border-radius: 2px;">
                                    <img :src="result?.qr_code" crossorigin="anonymous" alt="QR Verification" class="w-full h-full object-contain">
                                </div>

                            </div>
                            
                            <!-- Back Face of Front Card (Flipped) -->
                            <div class="card-back absolute inset-0 w-full h-full rounded-[24px]" 
                                 style="width: 340px; height: 538px; position: absolute; left: 0; top: 0;">
                                
                                <!-- Background Template Image (Back Face) -->
                                <img src="{{ asset('assets/amis-id-template-back.png') }}?v=3" crossorigin="anonymous" class="id-template absolute inset-0 w-full h-full object-cover pointer-events-none" style="z-index: 1; border-radius: 24px;" alt="AMIS ID Template Back">

                                <!-- Parent Name Overlay -->
                                <div x-show="result?.parent_name && !isParentMissing()"
                                     class="absolute text-center flex flex-col justify-center px-4" 
                                     style="left: 15px; top: 85px; width: 310px; height: 28px; z-index: 10;">
                                    <h3 class="font-black uppercase text-slate-900" 
                                        style="font-family: 'Outfit', sans-serif; line-height: 1.1;"
                                        x-bind:style="result?.parent_name?.length > 20 ? 'font-size: 18px;' : (result?.parent_name?.length > 14 ? 'font-size: 21px;' : 'font-size: 25px;')"
                                        x-text="result?.parent_name"></h3>
                                </div>

                                <!-- Contact Number Overlay -->
                                <div x-show="result?.parent_name && !isParentMissing()"
                                     class="absolute text-center flex flex-col justify-center px-4" 
                                     style="left: 15px; top: 118px; width: 310px; height: 20px; z-index: 10;">
                                    <h4 class="font-bold text-slate-800" 
                                        style="font-family: 'Outfit', sans-serif; font-size: 17px; line-height: 1;"
                                        x-text="result?.contact_no"></h4>
                                </div>

                                <!-- Address Overlay -->
                                <div x-show="result?.address && !isAddressMissing()"
                                     class="absolute text-center flex flex-col justify-center px-5" 
                                     style="left: 20px; top: 144px; width: 300px; height: 42px; z-index: 10;">
                                    <p class="font-bold uppercase text-slate-650" 
                                        style="font-family: 'Outfit', sans-serif; line-height: 1.25;"
                                        x-bind:style="result?.address?.length > 60 ? 'font-size: 10.5px;' : (result?.address?.length > 40 ? 'font-size: 12px;' : 'font-size: 13.5px;')"
                                        x-text="result?.address"></p>
                                </div>

                                <!-- Yellow Back Warning Stamp (Anti-edit / Missing Label) -->
                                <div x-show="isEmergencyMissing()"
                                     class="absolute flex flex-col items-center justify-center text-center p-3 border-2 border-dashed border-amber-400 bg-amber-50/95" 
                                     style="left: 15px; top: 83px; width: 310px; height: 104px; z-index: 15; border-radius: 12px; box-sizing: border-box;">
                                    <svg class="w-5 h-5 text-amber-600 animate-pulse mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <span class="font-black text-amber-950 text-[11px] uppercase tracking-wider" style="font-family: 'Outfit', sans-serif;">MISSING</span>
                                    <span class="font-bold text-amber-800 text-[8.5px] mt-1.5 leading-normal" style="font-family: 'Outfit', sans-serif;">Emergency details are missing.<br>Please update student profile.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BACK CARD CONTAINER -->
                    <div x-show="isFullScreen" x-cloak
                         class="perspective-1000 w-[340px] h-[538px] cursor-pointer animate-fade-in"
                         @click="flipBack = !flipBack" style="width: 340px; height: 538px; border-radius: 24px; position: relative;">
                        
                        <div class="card-inner w-full h-full relative"
                             :class="flipBack ? 'is-flipped' : ''" style="width: 100%; height: 100%;">
                            
                            <!-- Front Face of Back Card (Default: shows back face of ID) -->
                            <div id="id-card-back" class="card-front absolute inset-0 w-full h-full rounded-[24px]" 
                                 style="width: 340px; height: 538px; position: absolute; left: 0; top: 0;">
                                
                                <!-- Background Template Image (Back Face) -->
                                <img src="{{ asset('assets/amis-id-template-back.png') }}?v=3" crossorigin="anonymous" class="id-template absolute inset-0 w-full h-full object-cover pointer-events-none" style="z-index: 1; border-radius: 24px;" alt="AMIS ID Template Back">

                                <!-- Parent Name Overlay -->
                                <div x-show="result?.parent_name && !isParentMissing()"
                                     class="absolute text-center flex flex-col justify-center px-4" 
                                     style="left: 15px; top: 85px; width: 310px; height: 28px; z-index: 10;">
                                    <h3 class="font-black uppercase text-slate-900" 
                                        style="font-family: 'Outfit', sans-serif; line-height: 1.1;"
                                        x-bind:style="result?.parent_name?.length > 20 ? 'font-size: 18px;' : (result?.parent_name?.length > 14 ? 'font-size: 21px;' : 'font-size: 25px;')"
                                        x-text="result?.parent_name"></h3>
                                </div>

                                <!-- Contact Number Overlay -->
                                <div x-show="result?.parent_name && !isParentMissing()"
                                     class="absolute text-center flex flex-col justify-center px-4" 
                                     style="left: 15px; top: 118px; width: 310px; height: 20px; z-index: 10;">
                                    <h4 class="font-bold text-slate-800" 
                                        style="font-family: 'Outfit', sans-serif; font-size: 17px; line-height: 1;"
                                        x-text="result?.contact_no"></h4>
                                </div>

                                <!-- Address Overlay -->
                                <div x-show="result?.address && !isAddressMissing()"
                                     class="absolute text-center flex flex-col justify-center px-5" 
                                     style="left: 20px; top: 144px; width: 300px; height: 42px; z-index: 10;">
                                    <p class="font-bold uppercase text-slate-650" 
                                        style="font-family: 'Outfit', sans-serif; line-height: 1.25;"
                                        x-bind:style="result?.address?.length > 60 ? 'font-size: 10.5px;' : (result?.address?.length > 40 ? 'font-size: 12px;' : 'font-size: 13.5px;')"
                                        x-text="result?.address"></p>
                                </div>

                                <!-- Yellow Back Warning Stamp (Anti-edit / Missing Label) -->
                                <div x-show="isEmergencyMissing()"
                                     class="absolute flex flex-col items-center justify-center text-center p-3 border-2 border-dashed border-amber-400 bg-amber-50/95" 
                                     style="left: 15px; top: 83px; width: 310px; height: 104px; z-index: 15; border-radius: 12px; box-sizing: border-box;">
                                    <svg class="w-5 h-5 text-amber-600 animate-pulse mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <span class="font-black text-amber-950 text-[11px] uppercase tracking-wider" style="font-family: 'Outfit', sans-serif;">MISSING</span>
                                    <span class="font-bold text-amber-800 text-[8.5px] mt-1.5 leading-normal" style="font-family: 'Outfit', sans-serif;">Emergency details are missing.<br>Please update student profile.</span>
                                </div>

                            </div>
                            
                            <!-- Back Face of Back Card (Flipped: shows front face of ID) -->
                            <div class="card-back absolute inset-0 w-full h-full rounded-[24px]" 
                                 style="width: 340px; height: 538px; position: absolute; left: 0; top: 0;">
                                
                                <!-- Background Template Image -->
                                <img src="{{ asset('assets/amis-id-template.png') }}?v=3" crossorigin="anonymous" class="id-template absolute inset-0 w-full h-full object-cover pointer-events-none" style="z-index: 1; border-radius: 24px;" alt="AMIS ID Template">

                                <!-- Student Photo Overlay -->
                                <img x-show="result?.photo_url && !result.photo_url.includes('default-avatar')"
                                     :src="result?.photo_url" 
                                     crossorigin="anonymous"
                                     class="student-photo absolute" 
                                     style="left: 81px; top: 114px; width: 178px; height: 172px; overflow: hidden; border-radius: 14px; z-index: 10; object-fit: cover;"
                                     alt="Student Photo">

                                <!-- Yellow Photo Warning Stamp (Anti-edit) -->
                                <div x-show="!result?.photo_url || result.photo_url.includes('default-avatar')"
                                     class="absolute flex flex-col items-center justify-center text-center p-3" 
                                     style="left: 81px; top: 114px; width: 178px; height: 172px; z-index: 10; border-radius: 14px; background: #fef08a; border: 2.5px dashed #ca8a04; box-sizing: border-box;">
                                    <svg class="w-6 h-6 text-amber-600 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <span class="font-black text-amber-950 text-[10.5px] uppercase leading-tight" style="font-family: 'Outfit', sans-serif;">Warning</span>
                                    <span class="font-extrabold text-amber-900 text-[8.5px] mt-0.5 uppercase leading-tight" style="font-family: 'Outfit', sans-serif;">Incomplete ID Data</span>
                                    <span class="font-bold text-amber-800 text-[8px] mt-1.5 leading-normal" style="font-family: 'Outfit', sans-serif;">Photo is missing.<br>Please re-upload.</span>
                                </div>

                                <!-- Student ID Badge text overlay (No background color, centered transparent overlay on new blank template) -->
                                <div class="student-id absolute text-center flex items-center justify-center font-black tracking-wider text-[12.5px] text-white" 
                                     style="left: 121px; top: 295px; width: 95px; height: 15px; z-index: 10; background: transparent; line-height: 1;"
                                     x-text="result ? (result.student_id.startsWith('AMIS-') ? result.student_id.split('-')[1].substring(2,4) + parseInt(result.student_id.split('-')[2]).toString().padStart(4,'0') : result.student_id) : ''"></div>

                                <!-- Last Name Text Overlay -->
                                <div class="student-last-name absolute text-center flex flex-col justify-center px-4" 
                                     style="left: 15px; top: 334px; width: 310px; height: 32px; z-index: 10;">
                                    <h3 class="font-black uppercase text-slate-900 animate-fade-in" 
                                        style="font-family: 'Outfit', sans-serif; line-height: 1; letter-spacing: -0.5px;"
                                        x-bind:style="result?.last_name?.length > 20 ? 'font-size: 16px;' : (result?.last_name?.length > 15 ? 'font-size: 19px;' : (result?.last_name?.length > 10 ? 'font-size: 23px;' : 'font-size: 26px;'))"
                                        x-text="result?.last_name"></h3>
                                </div>

                                <!-- First Name / Middle Name Text Overlay -->
                                <div class="student-first-name absolute text-center flex flex-col justify-center px-4" 
                                     style="left: 15px; top: 366px; width: 310px; height: 22px; z-index: 10;">
                                    <h4 class="font-bold uppercase text-slate-700" 
                                        style="font-family: 'Outfit', sans-serif; line-height: 1;"
                                        x-bind:style="result?.first_name?.length > 25 ? 'font-size: 11px;' : (result?.first_name?.length > 18 ? 'font-size: 13px;' : 'font-size: 15px;')"
                                        x-text="result?.first_name"></h4>
                                </div>

                                <!-- Grade Level Text Overlay -->
                                <div class="student-grade absolute text-center flex flex-col justify-center px-4" 
                                     style="left: 15px; top: 406px; width: 310px; height: 30px; z-index: 10;">
                                    <span class="font-extrabold uppercase" 
                                          :style="'color: ' + getGradeColor(result?.grade_level)"
                                          style="font-family: 'Outfit', sans-serif; font-size: 26px; font-weight: 900; line-height: 1; letter-spacing: 0.5px; text-shadow: 0 1px 1px rgba(0,0,0,0.05);"
                                          x-text="result?.grade_level"></span>
                                </div>

                                <!-- LRN Overlay (Rotated 90deg, aligned to the right blank side, matching SY style on left) -->
                                <div x-show="result?.lrn && result.lrn !== 'N/A' && result.lrn !== 'NA' && result.lrn !== 'EMPTY' && result.lrn !== ''"
                                     class="absolute text-slate-800 font-bold" 
                                     style="font-family: 'Outfit', sans-serif; font-size: 15.5px; z-index: 10; right: 8px; top: 405px; width: 22px; height: 130px; display: flex; align-items: center; justify-content: center; transform: rotate(-90deg); transform-origin: center; white-space: nowrap; letter-spacing: 0.05em;">
                                    LRN: <span x-text="result?.lrn" style="margin-left: 4px;"></span>
                                </div>

                                <!-- QR Code Overlay (Aligned perfectly inside the template green square border) -->
                                <div class="student-qr absolute bg-white" style="left: 134.5px; top: 458px; width: 71px; height: 71px; z-index: 10; padding: 2.5px; border-radius: 2px;">
                                    <img :src="result?.qr_code" crossorigin="anonymous" alt="QR Verification" class="w-full h-full object-contain">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- BOTTOM PANEL: Control Actions & Warnings Panel (Centered directly below the ID card preview) -->
                <div class="flex flex-col items-center gap-5 w-full max-w-[340px] mt-4" x-show="!isFullScreen">
                    
                    <!-- Control Actions Panel (3 Icon Buttons in 1 Row) -->
                    <div class="w-full relative" style="z-index: 50;">
                        <div class="flex gap-2.5 w-full">
                            <!-- Full Screen Toggle Button -->
                            <button @click="isFullScreen = !isFullScreen"
                                    title="Full Screen Mode"
                                    style="border-radius: 12px; padding: 14px 0; border: none; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; color: white; background: #0f172a; transition: background 0.2s;"
                                    class="flex-1 hover:bg-slate-900 active:scale-[0.98]">
                                <!-- Full Screen Expand Icon -->
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path>
                                </svg>
                            </button>

                            <!-- Back Button -->
                            <button @click="showIdCard = false"
                                    title="Back to Form"
                                    style="border-radius: 12px; padding: 14px 0; border: none; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; color: #475569; background: #e2e8f0; transition: background 0.2s;"
                                    class="flex-1 hover:bg-slate-300 active:scale-[0.98]">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <line x1="19" y1="12" x2="5" y2="12"></line>
                                    <polyline points="12 19 5 12 12 5"></polyline>
                                </svg>
                            </button>
                            
                            <!-- Verify Another student -->
                            <button @click="student_id = ''; full_name = ''; grade_level = ''; errorMsg = ''; success = false; result = null; showIdCard = false; showCorrectionRequest = false;"
                                    title="Verify Another ID"
                                    style="border-radius: 12px; padding: 14px 0; border: none; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; color: #475569; background: #e2e8f0; transition: background 0.2s;"
                                    class="flex-1 hover:bg-slate-300 active:scale-[0.98]">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Warnings Panel (Shown only if there are missing details) -->
                    <div x-show="(!result?.photo_url || result.photo_url.includes('default-avatar')) || isEmergencyMissing()"
                         class="w-full bg-amber-50 border border-amber-200 rounded-xl p-4 flex flex-col gap-2.5 text-amber-850 text-xs shadow-sm animate-fade-in"
                         style="font-family: 'Outfit', sans-serif;">
                        <div class="flex items-center gap-2 font-bold text-amber-900 text-[13px]">
                            <svg class="w-4 h-4 text-amber-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span>Profile Warning: Incomplete ID Data</span>
                        </div>
                        <ul class="list-disc list-inside flex flex-col gap-1 text-amber-800 font-medium text-[11.5px]">
                            <template x-if="!result?.photo_url || result.photo_url.includes('default-avatar')">
                                <li><strong>Student Profile</strong> / <strong>Personal Details</strong> (Photo is missing)</li>
                            </template>
                            <template x-if="isParentMissing()">
                                <li><strong>Parent / Guardian Details</strong> (Emergency Contact is missing)</li>
                            </template>
                            <template x-if="isAddressMissing()">
                                <li><strong>Residence Address</strong> (Address is missing)</li>
                            </template>
                        </ul>
                        <div class="text-[11px] text-amber-700 font-bold mt-2 pt-2 border-t border-amber-200/60">
                            Or contact the Technical/IT / Email:
                            <div class="mt-1 text-[11.5px] flex items-center gap-1.5 flex-wrap font-bold">
                                <a href="https://www.facebook.com/zhaii97" target="_blank" class="text-blue-600 hover:text-blue-800 transition-colors underline">Sir Mohaymen</a>
                                <span class="text-amber-400 font-black">|</span>
                                <a href="https://www.facebook.com/sirmo.amis" target="_blank" class="text-blue-600 hover:text-blue-800 transition-colors underline">Sir Mon</a>
                                <span class="text-amber-400 font-black">|</span>
                                <a href="mailto:inquiries@amis.edu.ph" class="text-blue-600 hover:text-blue-800 transition-colors underline">inquiries@amis.edu.ph</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<!-- Load html2canvas and jsPDF for exporting card layout -->
<script src="{{ asset('assets/html2canvas-patched.js') }}?v=4"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<!-- Load Alpine.js CDN directly for this page -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
