<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMIS Digital Platform Roadmap</title>
    <meta name="description" content="Track the development milestones and enrollment flow of Al Munawwara Islamic School (AMIS) digital portals.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Inter','sans-serif'], display: ['Outfit','sans-serif'] } } }
        }
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --teal: #14b8a6;
            --amber: #f59e0b;
            --emerald: #10b981;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #070a12;
            color: #f1f5f9;
            overflow-x: hidden;
        }
        .font-display { font-family: 'Outfit', sans-serif; }

        /* ───── HERO ───── */
        .hero-section {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }
        .scroll-indicator {
            position: absolute;
            bottom: 2.5rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            animation: bounceDown 2s infinite ease-in-out;
        }
        @keyframes bounceDown {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50%       { transform: translateX(-50%) translateY(8px); }
        }

        /* ───── PORTAL CARDS ───── */
        .portal-column {
            background: #101524;
            border: 1px solid rgba(255,255,255,0.03);
            transition: transform 0.25s cubic-bezier(0.22,1,0.36,1), border-color 0.25s, box-shadow 0.25s;
        }
        .portal-column:hover {
            transform: translateY(-6px);
            border-color: rgba(20,184,166,0.4);
            box-shadow: 0 24px 32px -6px rgba(0,0,0,0.55);
        }
        .flow-node {
            background: rgba(17,24,39,0.45);
            border: 1px solid rgba(255,255,255,0.02);
            transition: border-color 0.2s;
        }
        .flow-node:hover { border-color: rgba(20,184,166,0.15); }

        /* card node entrance */
        .node-hidden {
            opacity: 0;
            transform: translateY(22px);
            transition: opacity 700ms cubic-bezier(0.22,1,0.36,1), transform 700ms cubic-bezier(0.22,1,0.36,1);
            will-change: transform, opacity;
        }
        .node-hidden.visible { opacity: 1; transform: none; }

        .check-pop {
            opacity: 0; transform: scale(0.4);
            transition: opacity 280ms ease, transform 280ms cubic-bezier(0.175,0.885,0.32,1.275);
        }
        .check-pop.visible { opacity: 1; transform: scale(1); }

        /* connector draw */
        .connector {
            background: rgba(255,255,255,0.03);
            position: relative; overflow: hidden;
            width: 2px; height: 0;
            transition: height 480ms cubic-bezier(0.22,1,0.36,1);
        }
        .connector.visible { height: 24px; }
        .connector .pulse {
            position: absolute; top: 0; left: 0;
            width: 100%; height: 10px;
            background: linear-gradient(180deg, transparent, var(--teal), transparent);
            transform: translateY(-10px);
            animation: connPulse 1.8s infinite linear;
        }
        .connector .pulse-amber {
            background: linear-gradient(180deg, transparent, var(--amber), transparent);
        }
        @keyframes connPulse {
            0%   { transform: translateY(-10px); }
            100% { transform: translateY(34px); }
        }
        .final-node {
            opacity: 0; transform: scale(0.93);
            transition: opacity 700ms cubic-bezier(0.22,1,0.36,1), transform 700ms cubic-bezier(0.22,1,0.36,1), box-shadow 700ms;
        }
        .final-node.visible { opacity: 1; transform: scale(1); }
        .final-node.glow-teal.visible { box-shadow: 0 0 18px rgba(20,184,166,0.25); }
        .final-node.glow-amber.visible { box-shadow: 0 0 18px rgba(245,158,11,0.25); }

        .pulse-task { animation: taskPulse 3s infinite ease-in-out; }
        @keyframes taskPulse {
            0%,100% { opacity:1; transform:scale(1); }
            50%     { opacity:0.7; transform:scale(1.01); }
        }

        /* ───── ENROLLMENT STICKY SECTION ───── */
        .enroll-section { position: relative; }

        .sticky-left {
            position: sticky;
            top: 6rem;
            align-self: flex-start;
            will-change: transform;
        }

        /* Glass preview card */
        .preview-card {
            background: rgba(16,21,36,0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 1.5rem;
            box-shadow: 0 32px 64px -12px rgba(0,0,0,0.7);
            transition: all 0.6s cubic-bezier(0.22,1,0.36,1);
            overflow: hidden;
        }
        .preview-screen {
            display: none;
            animation: fadeSlideUp 0.6s cubic-bezier(0.22,1,0.36,1) both;
        }
        .preview-screen.active { display: block; }
        @keyframes fadeSlideUp {
            from { opacity:0; transform:translateY(14px); }
            to   { opacity:1; transform:none; }
        }

        /* Phase timeline right side */
        .phase-block {
            min-height: 60vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem 0;
            position: relative;
        }
        .phase-card {
            background: rgba(16,21,36,0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.04);
            border-radius: 1.25rem;
            padding: 1.75rem;
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 700ms cubic-bezier(0.22,1,0.36,1),
                        transform 700ms cubic-bezier(0.22,1,0.36,1),
                        border-color 0.4s, box-shadow 0.4s;
            will-change: opacity, transform;
        }
        .phase-card.visible {
            opacity: 1;
            transform: none;
        }
        .phase-card.active-phase {
            border-color: rgba(20,184,166,0.35);
            box-shadow: 0 0 30px rgba(20,184,166,0.12), 0 16px 32px rgba(0,0,0,0.4);
        }
        .phase-card.done-phase {
            border-color: rgba(16,185,129,0.2);
            opacity: 0.75;
        }

        /* Vertical connector between phase blocks */
        .phase-connector-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0;
            opacity: 0;
            transition: opacity 500ms ease;
        }
        .phase-connector-wrap.visible { opacity: 1; }

        .phase-connector {
            width: 2px; height: 0;
            background: linear-gradient(180deg, rgba(20,184,166,0.5), rgba(20,184,166,0.1));
            position: relative; overflow: hidden;
            transition: height 600ms cubic-bezier(0.22,1,0.36,1);
        }
        .phase-connector-wrap.visible .phase-connector { height: 48px; }
        .phase-connector::after {
            content: '';
            position: absolute; top:0; left:0;
            width: 100%; height: 16px;
            background: linear-gradient(180deg, transparent, var(--teal), transparent);
            animation: connPulse 2s infinite linear;
        }
        .arrow-chevron {
            width: 28px; height: 28px;
            border-radius: 50%;
            background: rgba(20,184,166,0.12);
            border: 1px solid rgba(20,184,166,0.3);
            display: flex; align-items: center; justify-content: center;
            transform: scale(0);
            transition: transform 400ms cubic-bezier(0.175,0.885,0.32,1.275) 400ms;
        }
        .phase-connector-wrap.visible .arrow-chevron { transform: scale(1); }
        .arrow-chevron svg { color: #14b8a6; }

        /* Timeline date badge */
        .timeline-badge {
            display: inline-flex; align-items: center; gap: 0.375rem;
            padding: 0.25rem 0.625rem;
            border-radius: 99px;
            font-size: 10px; font-weight: 700;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.06);
            color: #94a3b8;
            letter-spacing: 0.04em;
        }

        .step-row {
            display: flex; align-items: flex-start; gap: 0.75rem;
            opacity: 0; transform: translateX(-12px);
            transition: opacity 400ms ease, transform 400ms cubic-bezier(0.22,1,0.36,1);
        }
        .step-row.visible { opacity:1; transform:none; }

        /* progress count badge */
        .count-badge { font-variant-numeric: tabular-nums; }

        /* ambient glows */
        .glow-blob { pointer-events:none; position:absolute; border-radius:9999px; filter:blur(80px); }
    </style>
</head>
<body>

    <!-- ═══════════ HERO ═══════════ -->
    <div class="glow-blob" style="width:55%;height:55%;top:-15%;left:-20%;background:rgba(20,184,166,0.06);"></div>
    <div class="glow-blob" style="width:55%;height:55%;bottom:-15%;right:-20%;background:rgba(16,185,129,0.04);"></div>

    <section class="hero-section px-6">
        <!-- nav -->
        <nav class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-6 py-4 border-b border-slate-800/50" style="background:rgba(7,10,18,0.85);backdrop-filter:blur(16px);">
            <div class="flex items-center gap-3">
                <img src="/logo.png" alt="AMIS" class="w-10 h-10 object-contain" onerror="this.style.display='none'">
                <div>
                    <p class="font-display font-black text-sm text-slate-100 tracking-wide">AMIS</p>
                    <p class="text-[10px] font-bold text-teal-400 uppercase tracking-widest">Al Munawwara Islamic School</p>
                </div>
            </div>
            <a href="/" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-slate-900 border border-slate-800 text-slate-300 hover:border-slate-700 hover:text-white transition-all">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Back
            </a>
        </nav>

        <!-- hero content -->
        <div class="max-w-2xl pt-20">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-teal-950/40 text-teal-400 border border-teal-500/20 mb-6">
                <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse"></span>
                System Flowcharts & Phase Progression
            </span>
            <h1 class="font-display text-5xl sm:text-6xl font-black text-slate-100 tracking-tight leading-none mb-6">
                Platform<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-400 via-emerald-400 to-teal-300">Roadmap</span>
            </h1>
            <p class="text-base text-slate-400 leading-relaxed max-w-lg">
                Scroll down to explore every portal's development phases, technology stack, and enrollment flow — step by step.
            </p>
        </div>

        <div class="scroll-indicator text-slate-500 text-xs font-bold">
            <i data-lucide="mouse" class="w-5 h-5 text-teal-500/60"></i>
            Scroll to explore
        </div>
    </section>

    <!-- ═══════════ 5 PORTAL CARDS ═══════════ -->
    <section class="py-24 px-4 sm:px-6 lg:px-8 max-w-[90rem] mx-auto">
        <div class="text-center mb-14">
            <p class="text-xs font-bold text-teal-400 uppercase tracking-widest mb-3">Digital Portals</p>
            <h2 class="font-display text-3xl sm:text-4xl font-black text-slate-100">5 System Portals</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-5 items-start">

            <!-- ─ ENROLLMENT ─ -->
            <div class="portal-column rounded-3xl p-5 flex flex-col items-center text-center">
                <a href="https://online.enrollment.amis.edu.ph" target="_blank" class="w-full flow-node node-hidden p-3.5 rounded-2xl flex flex-col items-center gap-1 transition">
                    <i data-lucide="globe" class="w-5 h-5 text-teal-400"></i>
                    <span class="text-xs font-black text-slate-200">Enrollment Portal</span>
                    <span class="text-[9px] text-slate-500 font-semibold">online.enrollment.amis.edu.ph</span>
                </a>
                <div class="connector mx-auto my-1"><div class="pulse"></div></div>
                <div class="w-full flow-node phase-card-sm node-hidden p-3.5 rounded-2xl flex flex-col items-center gap-1.5">
                    <div class="flex items-center gap-1.5 flex-wrap justify-center mb-1">
                        <span class="text-[9px] font-black text-teal-400 uppercase tracking-wider bg-teal-950/40 border border-teal-500/10 px-2 py-0.5 rounded-md">Phase 1</span>
                        <span class="text-[9px] font-bold text-emerald-400 bg-emerald-950/20 border border-emerald-500/10 px-1.5 py-0.5 rounded-full count-badge" data-target="100">0%</span>
                    </div>
                    <ul class="text-left w-full space-y-1 text-[11px] text-slate-300">
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>1. Student Sign-In</li>
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>2. Profile Form & Upload</li>
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>3. Registrar Validation</li>
                    </ul>
                </div>
                <div class="connector mx-auto my-1"><div class="pulse"></div></div>
                <div class="w-full flow-node node-hidden p-3.5 rounded-2xl flex flex-col items-center gap-1.5">
                    <div class="flex items-center gap-1.5 flex-wrap justify-center mb-1">
                        <span class="text-[9px] font-black text-teal-400 uppercase tracking-wider bg-teal-950/40 border border-teal-500/10 px-2 py-0.5 rounded-md">Phase 2</span>
                        <span class="text-[9px] font-bold text-emerald-400 bg-emerald-950/20 border border-emerald-500/10 px-1.5 py-0.5 rounded-full">100%</span>
                    </div>
                    <ul class="text-left w-full space-y-1 text-[11px] text-slate-300">
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>4. Tuition Receipt Upload</li>
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>5. Finance Auditing Ledger</li>
                    </ul>
                </div>
                <div class="connector mx-auto my-1"><div class="pulse"></div></div>
                <div class="w-full final-node glow-teal node-hidden bg-emerald-950/40 border border-emerald-500/20 p-3.5 rounded-2xl flex flex-col items-center gap-1">
                    <span class="text-[9px] font-extrabold text-slate-400 uppercase tracking-wider">Final Phase</span>
                    <span class="text-[11px] font-bold text-slate-200">Auto Print Enrollment Slip</span>
                </div>
            </div>

            <!-- ─ STUDENT ─ -->
            <div class="portal-column rounded-3xl p-5 flex flex-col items-center text-center">
                <a href="https://student.amis.edu.ph" target="_blank" class="w-full flow-node node-hidden p-3.5 rounded-2xl flex flex-col items-center gap-1 transition">
                    <i data-lucide="globe" class="w-5 h-5 text-amber-400"></i>
                    <span class="text-xs font-black text-slate-200">Student Portal</span>
                    <span class="text-[9px] text-slate-500 font-semibold">student.amis.edu.ph</span>
                </a>
                <div class="connector mx-auto my-1"><div class="pulse pulse-amber"></div></div>
                <div class="w-full flow-node node-hidden p-3.5 rounded-2xl flex flex-col items-center gap-1.5">
                    <div class="flex items-center gap-1.5 flex-wrap justify-center mb-1">
                        <span class="text-[9px] font-black text-teal-400 uppercase tracking-wider bg-teal-950/40 border border-teal-500/10 px-2 py-0.5 rounded-md">Phase 1</span>
                        <span class="text-[9px] font-bold text-emerald-400 bg-emerald-950/20 border border-emerald-500/10 px-1.5 py-0.5 rounded-full count-badge" data-target="100">0%</span>
                    </div>
                    <ul class="text-left w-full space-y-1 text-[11px] text-slate-300">
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>1. Microsoft SSO Log-In</li>
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>2. Section Verification</li>
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>3. Class Schedules Grid</li>
                    </ul>
                </div>
                <div class="connector mx-auto my-1"><div class="pulse pulse-amber"></div></div>
                <div class="w-full flow-node node-hidden p-3.5 rounded-2xl flex flex-col items-center gap-1.5">
                    <div class="flex items-center gap-1.5 flex-wrap justify-center mb-1">
                        <span class="text-[9px] font-black text-amber-400 uppercase tracking-wider bg-amber-950/40 border border-amber-500/10 px-2 py-0.5 rounded-md">Phase 2</span>
                        <span class="text-[9px] font-bold text-amber-400 bg-amber-950/20 border border-amber-500/10 px-1.5 py-0.5 rounded-full">82%</span>
                    </div>
                    <ul class="text-left w-full space-y-1 text-[11px] text-slate-300">
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>4. Digital Barcoded ID</li>
                        <li class="flex gap-1 items-start pulse-task"><span class="check-pop text-amber-400 mt-0.5"><i data-lucide="clock" class="w-3 h-3"></i></span>5. Tuition Statement (SOA)</li>
                    </ul>
                </div>
                <div class="connector mx-auto my-1"><div class="pulse pulse-amber"></div></div>
                <div class="w-full final-node glow-amber node-hidden bg-amber-950/40 border border-amber-500/20 p-3.5 rounded-2xl flex flex-col items-center gap-1">
                    <span class="text-[9px] font-extrabold text-slate-400 uppercase tracking-wider">Final Phase</span>
                    <span class="text-[11px] text-slate-300">Auto Print Report Cards</span>
                </div>
            </div>

            <!-- ─ FACULTY ─ -->
            <div class="portal-column rounded-3xl p-5 flex flex-col items-center text-center">
                <a href="https://teacher.amis.edu.ph" target="_blank" class="w-full flow-node node-hidden p-3.5 rounded-2xl flex flex-col items-center gap-1 transition">
                    <i data-lucide="globe" class="w-5 h-5 text-amber-400"></i>
                    <span class="text-xs font-black text-slate-200">Faculty Portal</span>
                    <span class="text-[9px] text-slate-500 font-semibold">teacher.amis.edu.ph</span>
                </a>
                <div class="connector mx-auto my-1"><div class="pulse pulse-amber"></div></div>
                <div class="w-full flow-node node-hidden p-3.5 rounded-2xl flex flex-col items-center gap-1.5">
                    <div class="flex items-center gap-1.5 flex-wrap justify-center mb-1">
                        <span class="text-[9px] font-black text-teal-400 uppercase tracking-wider bg-teal-950/40 border border-teal-500/10 px-2 py-0.5 rounded-md">Phase 1</span>
                        <span class="text-[9px] font-bold text-emerald-400 bg-emerald-950/20 border border-emerald-500/10 px-1.5 py-0.5 rounded-full count-badge" data-target="100">0%</span>
                    </div>
                    <ul class="text-left w-full space-y-1 text-[11px] text-slate-300">
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>1. Teacher SSO Log-In</li>
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>2. Assigned Sections</li>
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>3. Material Uploader</li>
                    </ul>
                </div>
                <div class="connector mx-auto my-1"><div class="pulse pulse-amber"></div></div>
                <div class="w-full flow-node node-hidden p-3.5 rounded-2xl flex flex-col items-center gap-1.5">
                    <div class="flex items-center gap-1.5 flex-wrap justify-center mb-1">
                        <span class="text-[9px] font-black text-amber-400 uppercase tracking-wider bg-amber-950/40 border border-amber-500/10 px-2 py-0.5 rounded-md">Phase 2</span>
                        <span class="text-[9px] font-bold text-amber-400 bg-amber-950/20 border border-amber-500/10 px-1.5 py-0.5 rounded-full">78%</span>
                    </div>
                    <ul class="text-left w-full space-y-1 text-[11px] text-slate-300">
                        <li class="flex gap-1 items-start pulse-task"><span class="check-pop text-amber-400 mt-0.5"><i data-lucide="clock" class="w-3 h-3"></i></span>4. Online Grade Encoder</li>
                        <li class="flex gap-1 items-start pulse-task"><span class="check-pop text-amber-400 mt-0.5"><i data-lucide="clock" class="w-3 h-3"></i></span>5. Attendance Logs</li>
                    </ul>
                </div>
                <div class="connector mx-auto my-1"><div class="pulse pulse-amber"></div></div>
                <div class="w-full final-node glow-amber node-hidden bg-amber-950/40 border border-amber-500/20 p-3.5 rounded-2xl flex flex-col items-center gap-1">
                    <span class="text-[9px] font-extrabold text-slate-400 uppercase tracking-wider">Final Phase</span>
                    <span class="text-[11px] text-slate-300">Auto Generate Grades PDF</span>
                </div>
            </div>

            <!-- ─ ADMIN ─ -->
            <div class="portal-column rounded-3xl p-5 flex flex-col items-center text-center">
                <a href="https://admin.amis.edu.ph" target="_blank" class="w-full flow-node node-hidden p-3.5 rounded-2xl flex flex-col items-center gap-1 transition">
                    <i data-lucide="globe" class="w-5 h-5 text-teal-400"></i>
                    <span class="text-xs font-black text-slate-200">Admin Portal</span>
                    <span class="text-[9px] text-slate-500 font-semibold">admin.amis.edu.ph</span>
                </a>
                <div class="connector mx-auto my-1"><div class="pulse"></div></div>
                <div class="w-full flow-node node-hidden p-3.5 rounded-2xl flex flex-col items-center gap-1.5">
                    <div class="flex items-center gap-1.5 flex-wrap justify-center mb-1">
                        <span class="text-[9px] font-black text-teal-400 uppercase tracking-wider bg-teal-950/40 border border-teal-500/10 px-2 py-0.5 rounded-md">Phase 1</span>
                        <span class="text-[9px] font-bold text-emerald-400 bg-emerald-950/20 border border-emerald-500/10 px-1.5 py-0.5 rounded-full count-badge" data-target="100">0%</span>
                    </div>
                    <ul class="text-left w-full space-y-1 text-[11px] text-slate-300">
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>1. Secure Admin Login</li>
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>2. Section & Timetable Builder</li>
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>3. Advisory Allocations</li>
                    </ul>
                </div>
                <div class="connector mx-auto my-1"><div class="pulse"></div></div>
                <div class="w-full flow-node node-hidden p-3.5 rounded-2xl flex flex-col items-center gap-1.5">
                    <div class="flex items-center gap-1.5 flex-wrap justify-center mb-1">
                        <span class="text-[9px] font-black text-teal-400 uppercase tracking-wider bg-teal-950/40 border border-teal-500/10 px-2 py-0.5 rounded-md">Phase 2</span>
                        <span class="text-[9px] font-bold text-emerald-400 bg-emerald-950/20 border border-emerald-500/10 px-1.5 py-0.5 rounded-full">100%</span>
                    </div>
                    <ul class="text-left w-full space-y-1 text-[11px] text-slate-300">
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>4. Microsoft Teams Sync</li>
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>5. Finance Ledger Auditor</li>
                    </ul>
                </div>
                <div class="connector mx-auto my-1"><div class="pulse"></div></div>
                <div class="w-full final-node glow-teal node-hidden bg-emerald-950/40 border border-emerald-500/20 p-3.5 rounded-2xl flex flex-col items-center gap-1">
                    <span class="text-[9px] font-extrabold text-slate-400 uppercase tracking-wider">Final Phase</span>
                    <span class="text-[11px] font-bold text-slate-200">Auto Generate Section Excel</span>
                </div>
            </div>

            <!-- ─ FINANCE ─ -->
            <div class="portal-column rounded-3xl p-5 flex flex-col items-center text-center">
                <a href="https://payment.amis.edu.ph" target="_blank" class="w-full flow-node node-hidden p-3.5 rounded-2xl flex flex-col items-center gap-1 transition">
                    <i data-lucide="globe" class="w-5 h-5 text-amber-400"></i>
                    <span class="text-xs font-black text-slate-200">Finance Portal</span>
                    <span class="text-[9px] text-slate-500 font-semibold">payment.amis.edu.ph</span>
                </a>
                <div class="connector mx-auto my-1"><div class="pulse pulse-amber"></div></div>
                <div class="w-full flow-node node-hidden p-3.5 rounded-2xl flex flex-col items-center gap-1.5">
                    <div class="flex items-center gap-1.5 flex-wrap justify-center mb-1">
                        <span class="text-[9px] font-black text-teal-400 uppercase tracking-wider bg-teal-950/40 border border-teal-500/10 px-2 py-0.5 rounded-md">Phase 1</span>
                        <span class="text-[9px] font-bold text-emerald-400 bg-emerald-950/20 border border-emerald-500/10 px-1.5 py-0.5 rounded-full count-badge" data-target="100">0%</span>
                    </div>
                    <ul class="text-left w-full space-y-1 text-[11px] text-slate-300">
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>1. Reference Receipt Upload</li>
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>2. Manual Ledger Mapping</li>
                    </ul>
                </div>
                <div class="connector mx-auto my-1"><div class="pulse pulse-amber"></div></div>
                <div class="w-full flow-node node-hidden p-3.5 rounded-2xl flex flex-col items-center gap-1.5">
                    <div class="flex items-center gap-1.5 flex-wrap justify-center mb-1">
                        <span class="text-[9px] font-black text-amber-400 uppercase tracking-wider bg-amber-950/40 border border-amber-500/10 px-2 py-0.5 rounded-md">Phase 2</span>
                        <span class="text-[9px] font-bold text-amber-400 bg-amber-950/20 border border-amber-500/10 px-1.5 py-0.5 rounded-full">60%</span>
                    </div>
                    <ul class="text-left w-full space-y-1 text-[11px] text-slate-300">
                        <li class="flex gap-1 items-start"><span class="check-pop text-emerald-400 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></span>3. Real-Time Balance Sync</li>
                        <li class="flex gap-1 items-start pulse-task"><span class="check-pop text-amber-400 mt-0.5"><i data-lucide="clock" class="w-3 h-3"></i></span>4. Direct Maya Gateway</li>
                    </ul>
                </div>
                <div class="connector mx-auto my-1"><div class="pulse pulse-amber"></div></div>
                <div class="w-full final-node glow-amber node-hidden bg-amber-950/40 border border-amber-500/20 p-3.5 rounded-2xl flex flex-col items-center gap-1">
                    <span class="text-[9px] font-extrabold text-slate-400 uppercase tracking-wider">Final Phase</span>
                    <span class="text-[11px] text-slate-300">Auto Print Official Receipt</span>
                </div>
            </div>

        </div>
    </section>

    <!-- ═══════════ ONLINE ENROLLMENT SECTION ═══════════ -->
    <section class="py-24 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">

        <!-- "Online Enrollment Started" banner -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-16">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-teal-400 animate-pulse"></span>
                    <span class="text-xs font-black text-teal-400 uppercase tracking-widest">Online Enrollment</span>
                </div>
                <h2 class="font-display text-4xl sm:text-5xl font-black text-slate-100 leading-tight">
                    Enrollment <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-emerald-400">Started</span>
                </h2>
                <p class="text-slate-400 text-sm mt-2 max-w-md">Scroll through the step-by-step flow of the student enrollment process.</p>
            </div>
            <div class="flex-shrink-0 bg-teal-950/40 border border-teal-500/20 rounded-2xl px-5 py-3 text-right">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-wider">Enrollment Period</p>
                <p class="text-base font-black text-teal-300 mt-0.5">Aug 1 – Sep 1, 2024</p>
                <p class="text-[10px] text-slate-500 mt-0.5">online.enrollment.amis.edu.ph</p>
            </div>
        </div>

        <!-- Phase rows: LEFT CARD → ARROW → RIGHT CARD -->
        <div class="space-y-6" id="enrollPhases">

            <!-- ── PHASE 1 ── -->
            <div class="enroll-row opacity-0 translate-y-8 transition-all duration-700" style="transition-timing-function:cubic-bezier(0.22,1,0.36,1);">
                <div class="grid grid-cols-1 lg:grid-cols-[1fr_auto_1fr] items-center gap-4">

                    <!-- Left card: phase identity -->
                    <div class="glass-card p-5 rounded-2xl border border-teal-500/15" style="background:rgba(20,184,166,0.04);">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-teal-950/80 border border-teal-500/25 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="user-plus" class="w-5 h-5 text-teal-400"></i>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-teal-400 uppercase tracking-widest">Phase 1</p>
                                <h3 class="font-display text-lg font-black text-slate-100 leading-tight">Student Registration</h3>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-slate-400 bg-white/[0.03] border border-white/[0.05] px-2.5 py-1 rounded-full">
                                <i data-lucide="calendar" class="w-3 h-3"></i> Aug 1–15, 2024
                            </span>
                            <span class="text-xs font-black text-emerald-400 bg-emerald-950/40 border border-emerald-500/20 px-2.5 py-1 rounded-full">100%</span>
                        </div>
                    </div>

                    <!-- Center arrow -->
                    <div class="center-arrow flex flex-col items-center gap-1 opacity-0 scale-75 transition-all duration-500" style="transition-delay:350ms;transition-timing-function:cubic-bezier(0.175,0.885,0.32,1.275);">
                        <div class="hidden lg:flex items-center gap-1">
                            <div class="w-8 h-px bg-gradient-to-r from-transparent to-teal-400/60"></div>
                            <div class="w-8 h-8 rounded-full bg-teal-950/80 border border-teal-500/30 flex items-center justify-center">
                                <i data-lucide="arrow-right" class="w-4 h-4 text-teal-400"></i>
                            </div>
                            <div class="w-8 h-px bg-gradient-to-l from-transparent to-teal-400/60"></div>
                        </div>
                        <!-- Mobile: down arrow -->
                        <div class="flex lg:hidden w-8 h-8 rounded-full bg-teal-950/80 border border-teal-500/30 items-center justify-center mx-auto">
                            <i data-lucide="arrow-down" class="w-4 h-4 text-teal-400"></i>
                        </div>
                    </div>

                    <!-- Right card: steps -->
                    <div class="glass-card p-5 rounded-2xl border border-white/[0.04]" style="background:rgba(16,21,36,0.6);backdrop-filter:blur(12px);">
                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-3">Process Flow</p>
                        <ul class="space-y-2.5">
                            <li class="step-item flex items-start gap-2.5 opacity-0 -translate-x-3 transition-all duration-400" style="transition-delay:100ms;">
                                <span class="w-5 h-5 rounded-full bg-emerald-950/80 border border-emerald-500/30 flex items-center justify-center flex-shrink-0 mt-0.5"><i data-lucide="check" class="w-3 h-3 text-emerald-400"></i></span>
                                <div><p class="text-sm font-bold text-slate-200">Student Sign-In</p><p class="text-[11px] text-slate-500">SSO via Microsoft or Google @amis.edu.ph</p></div>
                            </li>
                            <li class="step-item flex items-start gap-2.5 opacity-0 -translate-x-3 transition-all duration-400" style="transition-delay:200ms;">
                                <span class="w-5 h-5 rounded-full bg-emerald-950/80 border border-emerald-500/30 flex items-center justify-center flex-shrink-0 mt-0.5"><i data-lucide="check" class="w-3 h-3 text-emerald-400"></i></span>
                                <div><p class="text-sm font-bold text-slate-200">Profile Form</p><p class="text-[11px] text-slate-500">Personal info, grade level, guardian details</p></div>
                            </li>
                            <li class="step-item flex items-start gap-2.5 opacity-0 -translate-x-3 transition-all duration-400" style="transition-delay:300ms;">
                                <span class="w-5 h-5 rounded-full bg-emerald-950/80 border border-emerald-500/30 flex items-center justify-center flex-shrink-0 mt-0.5"><i data-lucide="check" class="w-3 h-3 text-emerald-400"></i></span>
                                <div><p class="text-sm font-bold text-slate-200">Upload Documents</p><p class="text-[11px] text-slate-500">PSA birth cert, F138 report card, 2×2 photo</p></div>
                            </li>
                            <li class="step-item flex items-start gap-2.5 opacity-0 -translate-x-3 transition-all duration-400" style="transition-delay:400ms;">
                                <span class="w-5 h-5 rounded-full bg-emerald-950/80 border border-emerald-500/30 flex items-center justify-center flex-shrink-0 mt-0.5"><i data-lucide="check" class="w-3 h-3 text-emerald-400"></i></span>
                                <div><p class="text-sm font-bold text-slate-200">Registration Validation</p><p class="text-[11px] text-slate-500">Registrar reviews and approves application</p></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Down connector 1→2 -->
            <div class="down-conn flex flex-col items-center gap-0 opacity-0 transition-opacity duration-500" style="transition-delay:200ms;">
                <div class="down-line w-px bg-gradient-to-b from-teal-400/50 to-teal-400/10" style="height:0;transition:height 500ms cubic-bezier(0.22,1,0.36,1);"></div>
                <div class="w-7 h-7 rounded-full bg-slate-900 border border-teal-500/30 flex items-center justify-center transform scale-0 transition-transform duration-400 delay-300">
                    <i data-lucide="chevron-down" class="w-4 h-4 text-teal-400"></i>
                </div>
            </div>

            <!-- ── PHASE 2 ── -->
            <div class="enroll-row opacity-0 translate-y-8 transition-all duration-700" style="transition-timing-function:cubic-bezier(0.22,1,0.36,1);">
                <div class="grid grid-cols-1 lg:grid-cols-[1fr_auto_1fr] items-center gap-4">

                    <!-- Left card -->
                    <div class="glass-card p-5 rounded-2xl border border-amber-500/15" style="background:rgba(245,158,11,0.04);">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-950/80 border border-amber-500/25 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="credit-card" class="w-5 h-5 text-amber-400"></i>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-amber-400 uppercase tracking-widest">Phase 2</p>
                                <h3 class="font-display text-lg font-black text-slate-100 leading-tight">Payment Verification</h3>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-slate-400 bg-white/[0.03] border border-white/[0.05] px-2.5 py-1 rounded-full">
                                <i data-lucide="calendar" class="w-3 h-3"></i> Aug 16–25, 2024
                            </span>
                            <span class="text-xs font-black text-emerald-400 bg-emerald-950/40 border border-emerald-500/20 px-2.5 py-1 rounded-full">100%</span>
                        </div>
                    </div>

                    <!-- Arrow -->
                    <div class="center-arrow flex flex-col items-center gap-1 opacity-0 scale-75 transition-all duration-500" style="transition-delay:350ms;transition-timing-function:cubic-bezier(0.175,0.885,0.32,1.275);">
                        <div class="hidden lg:flex items-center gap-1">
                            <div class="w-8 h-px bg-gradient-to-r from-transparent to-amber-400/60"></div>
                            <div class="w-8 h-8 rounded-full bg-amber-950/80 border border-amber-500/30 flex items-center justify-center">
                                <i data-lucide="arrow-right" class="w-4 h-4 text-amber-400"></i>
                            </div>
                            <div class="w-8 h-px bg-gradient-to-l from-transparent to-amber-400/60"></div>
                        </div>
                        <div class="flex lg:hidden w-8 h-8 rounded-full bg-amber-950/80 border border-amber-500/30 items-center justify-center mx-auto">
                            <i data-lucide="arrow-down" class="w-4 h-4 text-amber-400"></i>
                        </div>
                    </div>

                    <!-- Right card: steps -->
                    <div class="glass-card p-5 rounded-2xl border border-white/[0.04]" style="background:rgba(16,21,36,0.6);backdrop-filter:blur(12px);">
                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-3">Process Flow</p>
                        <ul class="space-y-2.5">
                            <li class="step-item flex items-start gap-2.5 opacity-0 -translate-x-3 transition-all duration-400" style="transition-delay:100ms;">
                                <span class="w-5 h-5 rounded-full bg-emerald-950/80 border border-emerald-500/30 flex items-center justify-center flex-shrink-0 mt-0.5"><i data-lucide="check" class="w-3 h-3 text-emerald-400"></i></span>
                                <div><p class="text-sm font-bold text-slate-200">Upload Tuition Receipt</p><p class="text-[11px] text-slate-500">GCash, Maya, or bank deposit with reference no.</p></div>
                            </li>
                            <li class="step-item flex items-start gap-2.5 opacity-0 -translate-x-3 transition-all duration-400" style="transition-delay:200ms;">
                                <span class="w-5 h-5 rounded-full bg-emerald-950/80 border border-emerald-500/30 flex items-center justify-center flex-shrink-0 mt-0.5"><i data-lucide="check" class="w-3 h-3 text-emerald-400"></i></span>
                                <div><p class="text-sm font-bold text-slate-200">Finance Checks Payment</p><p class="text-[11px] text-slate-500">Finance team validates receipt against bank records</p></div>
                            </li>
                            <li class="step-item flex items-start gap-2.5 opacity-0 -translate-x-3 transition-all duration-400" style="transition-delay:300ms;">
                                <span class="w-5 h-5 rounded-full bg-emerald-950/80 border border-emerald-500/30 flex items-center justify-center flex-shrink-0 mt-0.5"><i data-lucide="check" class="w-3 h-3 text-emerald-400"></i></span>
                                <div><p class="text-sm font-bold text-slate-200">Admin Approves Payment</p><p class="text-[11px] text-slate-500">Admin marks verified, triggers next phase</p></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Down connector 2→3 -->
            <div class="down-conn flex flex-col items-center gap-0 opacity-0 transition-opacity duration-500" style="transition-delay:200ms;">
                <div class="down-line w-px bg-gradient-to-b from-emerald-400/50 to-emerald-400/10" style="height:0;transition:height 500ms cubic-bezier(0.22,1,0.36,1);"></div>
                <div class="w-7 h-7 rounded-full bg-slate-900 border border-emerald-500/30 flex items-center justify-center transform scale-0 transition-transform duration-400 delay-300">
                    <i data-lucide="chevron-down" class="w-4 h-4 text-emerald-400"></i>
                </div>
            </div>

            <!-- ── PHASE 3 ── -->
            <div class="enroll-row opacity-0 translate-y-8 transition-all duration-700" style="transition-timing-function:cubic-bezier(0.22,1,0.36,1);">
                <div class="grid grid-cols-1 lg:grid-cols-[1fr_auto_1fr] items-center gap-4">

                    <!-- Left card -->
                    <div class="glass-card p-5 rounded-2xl border border-emerald-500/15" style="background:rgba(16,185,129,0.04);">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-950/80 border border-emerald-500/25 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="shield-check" class="w-5 h-5 text-emerald-400"></i>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-emerald-400 uppercase tracking-widest">Phase 3</p>
                                <h3 class="font-display text-lg font-black text-slate-100 leading-tight">Approval & Account</h3>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-slate-400 bg-white/[0.03] border border-white/[0.05] px-2.5 py-1 rounded-full">
                                <i data-lucide="calendar" class="w-3 h-3"></i> Aug 26–31, 2024
                            </span>
                            <span class="text-xs font-black text-emerald-400 bg-emerald-950/40 border border-emerald-500/20 px-2.5 py-1 rounded-full">100%</span>
                        </div>
                    </div>

                    <!-- Arrow -->
                    <div class="center-arrow flex flex-col items-center gap-1 opacity-0 scale-75 transition-all duration-500" style="transition-delay:350ms;transition-timing-function:cubic-bezier(0.175,0.885,0.32,1.275);">
                        <div class="hidden lg:flex items-center gap-1">
                            <div class="w-8 h-px bg-gradient-to-r from-transparent to-emerald-400/60"></div>
                            <div class="w-8 h-8 rounded-full bg-emerald-950/80 border border-emerald-500/30 flex items-center justify-center">
                                <i data-lucide="arrow-right" class="w-4 h-4 text-emerald-400"></i>
                            </div>
                            <div class="w-8 h-px bg-gradient-to-l from-transparent to-emerald-400/60"></div>
                        </div>
                        <div class="flex lg:hidden w-8 h-8 rounded-full bg-emerald-950/80 border border-emerald-500/30 items-center justify-center mx-auto">
                            <i data-lucide="arrow-down" class="w-4 h-4 text-emerald-400"></i>
                        </div>
                    </div>

                    <!-- Right card: steps -->
                    <div class="glass-card p-5 rounded-2xl border border-white/[0.04]" style="background:rgba(16,21,36,0.6);backdrop-filter:blur(12px);">
                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-3">Process Flow</p>
                        <ul class="space-y-2.5">
                            <li class="step-item flex items-start gap-2.5 opacity-0 -translate-x-3 transition-all duration-400" style="transition-delay:100ms;">
                                <span class="w-5 h-5 rounded-full bg-emerald-950/80 border border-emerald-500/30 flex items-center justify-center flex-shrink-0 mt-0.5"><i data-lucide="check" class="w-3 h-3 text-emerald-400"></i></span>
                                <div><p class="text-sm font-bold text-slate-200">Enrollment Approved</p><p class="text-[11px] text-slate-500">System marks student as "Officially Enrolled"</p></div>
                            </li>
                            <li class="step-item flex items-start gap-2.5 opacity-0 -translate-x-3 transition-all duration-400" style="transition-delay:200ms;">
                                <span class="w-5 h-5 rounded-full bg-emerald-950/80 border border-emerald-500/30 flex items-center justify-center flex-shrink-0 mt-0.5"><i data-lucide="check" class="w-3 h-3 text-emerald-400"></i></span>
                                <div><p class="text-sm font-bold text-slate-200">AMIS ID Generated</p><p class="text-[11px] text-slate-500">Unique ID: <span class="font-mono text-teal-400">AMIS-2024-XXXXX</span></p></div>
                            </li>
                            <li class="step-item flex items-start gap-2.5 opacity-0 -translate-x-3 transition-all duration-400" style="transition-delay:300ms;">
                                <span class="w-5 h-5 rounded-full bg-emerald-950/80 border border-emerald-500/30 flex items-center justify-center flex-shrink-0 mt-0.5"><i data-lucide="check" class="w-3 h-3 text-emerald-400"></i></span>
                                <div><p class="text-sm font-bold text-slate-200">Microsoft Account Created</p><p class="text-[11px] text-slate-500"><span class="font-mono text-teal-400">firstname.lastname@amis.edu.ph</span></p></div>
                            </li>
                            <li class="step-item flex items-start gap-2.5 opacity-0 -translate-x-3 transition-all duration-400" style="transition-delay:400ms;">
                                <span class="w-5 h-5 rounded-full bg-emerald-950/80 border border-emerald-500/30 flex items-center justify-center flex-shrink-0 mt-0.5"><i data-lucide="check" class="w-3 h-3 text-emerald-400"></i></span>
                                <div><p class="text-sm font-bold text-slate-200">Welcome Email Sent</p><p class="text-[11px] text-slate-500">Credentials, schedule, and portal links included</p></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Down connector 3→Final -->
            <div class="down-conn flex flex-col items-center gap-0 opacity-0 transition-opacity duration-500" style="transition-delay:200ms;">
                <div class="down-line w-px bg-gradient-to-b from-teal-400/50 to-teal-400/10" style="height:0;transition:height 500ms cubic-bezier(0.22,1,0.36,1);"></div>
                <div class="w-7 h-7 rounded-full bg-slate-900 border border-teal-500/30 flex items-center justify-center transform scale-0 transition-transform duration-400 delay-300">
                    <i data-lucide="chevron-down" class="w-4 h-4 text-teal-400"></i>
                </div>
            </div>

            <!-- ── FINAL OUTPUT ── -->
            <div class="enroll-row opacity-0 translate-y-8 transition-all duration-700" style="transition-timing-function:cubic-bezier(0.22,1,0.36,1);">
                <div class="rounded-2xl border border-teal-500/20 p-6" style="background:linear-gradient(135deg,rgba(20,184,166,0.06),rgba(16,185,129,0.04));backdrop-filter:blur(12px);">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-xl bg-teal-950/80 border border-teal-500/30 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="party-popper" class="w-5 h-5 text-teal-400"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-teal-400 uppercase tracking-widest">Final Output</p>
                            <h3 class="font-display text-xl font-black text-slate-100">Enrollment Complete</h3>
                        </div>
                        <span class="ml-auto inline-flex items-center gap-1.5 text-[10px] font-bold text-teal-400 bg-teal-950/40 border border-teal-500/20 px-3 py-1 rounded-full">
                            <i data-lucide="calendar-check" class="w-3 h-3"></i> Sep 1, 2024 onwards
                        </span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="step-item flex items-center gap-3 bg-teal-950/50 border border-teal-500/20 rounded-xl p-3.5 opacity-0 translate-y-3 transition-all duration-500" style="transition-delay:100ms;">
                            <i data-lucide="printer" class="w-5 h-5 text-teal-400 flex-shrink-0"></i>
                            <div>
                                <p class="text-sm font-bold text-teal-300">Auto Print Enrollment Slip</p>
                                <p class="text-[10px] text-slate-400 mt-0.5">PDF auto-generated & downloadable</p>
                            </div>
                        </div>
                        <div class="step-item flex items-center gap-3 bg-emerald-950/50 border border-emerald-500/20 rounded-xl p-3.5 opacity-0 translate-y-3 transition-all duration-500" style="transition-delay:220ms;">
                            <i data-lucide="layout-dashboard" class="w-5 h-5 text-emerald-400 flex-shrink-0"></i>
                            <div>
                                <p class="text-sm font-bold text-emerald-300">Access Student Portal</p>
                                <p class="text-[10px] text-slate-400 mt-0.5">student.amis.edu.ph — full access</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <div class="h-24"></div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();

        function countUp(el, target, duration = 900) {
            let start = null;
            const step = ts => {
                if (!start) start = ts;
                const p = Math.min((ts - start) / duration, 1);
                el.textContent = Math.floor(p * target) + '%';
                if (p < 1) requestAnimationFrame(step);
            };
            requestAnimationFrame(step);
        }

        /* ── Portal card nodes ── */
        const nodeObs = new IntersectionObserver((entries, obs) => {
            entries.forEach(e => {
                if (!e.isIntersecting) return;
                const el = e.target;
                el.classList.add('visible');
                el.querySelectorAll('.count-badge[data-target]').forEach(b => countUp(b, parseInt(b.dataset.target)));
                el.querySelectorAll('.check-pop').forEach((c, i) => setTimeout(() => c.classList.add('visible'), i * 110));
                obs.unobserve(el);
            });
        }, { threshold: 0.18 });
        document.querySelectorAll('.node-hidden').forEach(el => nodeObs.observe(el));

        const finalObs = new IntersectionObserver((entries, obs) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); } });
        }, { threshold: 0.18 });
        document.querySelectorAll('.final-node').forEach(el => finalObs.observe(el));

        const connObs = new IntersectionObserver((entries, obs) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); } });
        }, { threshold: 0.18 });
        document.querySelectorAll('.connector').forEach(el => connObs.observe(el));

        /* ── Enrollment rows ── */
        const rows = document.querySelectorAll('.enroll-row');
        const conns = document.querySelectorAll('.down-conn');

        const rowObs = new IntersectionObserver((entries, obs) => {
            entries.forEach(e => {
                if (!e.isIntersecting) return;
                const row = e.target;
                // 1. Animate the row in
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
                // 2. Animate center arrow
                const arrow = row.querySelector('.center-arrow');
                if (arrow) {
                    arrow.style.opacity = '1';
                    arrow.style.transform = 'scale(1)';
                }
                // 3. Animate step items inside right card
                row.querySelectorAll('.step-item').forEach(s => {
                    s.style.opacity = '1';
                    s.style.transform = 'none';
                });

                // 4. Reveal the down connector that follows this row
                const rowIdx = Array.from(rows).indexOf(row);
                const conn = conns[rowIdx];
                if (conn) {
                    setTimeout(() => {
                        conn.style.opacity = '1';
                        const line = conn.querySelector('.down-line');
                        if (line) line.style.height = '40px';
                        const chevron = conn.querySelector('.w-7');
                        if (chevron) {
                            chevron.style.transform = 'scale(1)';
                        }
                    }, 600);
                }
                obs.unobserve(row);
            });
        }, { threshold: 0.25 });

        rows.forEach(r => rowObs.observe(r));
    });
    </script>
</body>
</html>


        <!-- Section header -->
        <div class="text-center mb-20">
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold bg-teal-950/40 text-teal-400 border border-teal-500/20 mb-5">
                <i data-lucide="layers" class="w-3.5 h-3.5"></i>
                Detailed Enrollment Flow
            </span>
            <h2 class="font-display text-4xl sm:text-5xl font-black text-slate-100 mb-4">
                Online <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-emerald-400">Enrollment Portal</span>
            </h2>
            <p class="text-slate-400 text-base max-w-lg mx-auto">
                A step-by-step visual flow of the student enrollment process — scroll to reveal each phase.
            </p>
        </div>

        <!-- Sticky layout wrapper -->
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 relative">

            <!-- LEFT: Sticky Preview Card -->
            <div class="lg:w-5/12 sticky-left hidden lg:block">
                <div class="preview-card p-6" id="previewCard">

                    <!-- Phase 1 Preview -->
                    <div class="preview-screen active" id="preview-1">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="w-2.5 h-2.5 rounded-full bg-teal-400"></span>
                            <span class="text-xs font-bold text-teal-400 uppercase tracking-wider">Phase 1</span>
                        </div>
                        <h3 class="font-display text-xl font-black text-slate-100 mb-1">Student Registration</h3>
                        <p class="text-xs text-slate-400 mb-5">Student submits profile and supporting documents.</p>
                        <!-- Mock form UI -->
                        <div class="space-y-2.5">
                            <div class="bg-slate-900/60 border border-slate-800 rounded-xl px-3 py-2">
                                <p class="text-[9px] font-bold text-slate-500 uppercase tracking-wider">Full Name</p>
                                <p class="text-xs text-slate-300 font-medium mt-0.5">Ahmad Ibn Khalid</p>
                            </div>
                            <div class="bg-slate-900/60 border border-slate-800 rounded-xl px-3 py-2">
                                <p class="text-[9px] font-bold text-slate-500 uppercase tracking-wider">Grade Level</p>
                                <p class="text-xs text-slate-300 font-medium mt-0.5">Grade 10 — Aqsa</p>
                            </div>
                            <div class="bg-slate-900/60 border border-slate-800 rounded-xl px-3 py-2">
                                <p class="text-[9px] font-bold text-slate-500 uppercase tracking-wider">Documents</p>
                                <div class="flex items-center gap-1.5 mt-1">
                                    <i data-lucide="file-check" class="w-3 h-3 text-emerald-400"></i>
                                    <span class="text-[10px] text-emerald-400">PSA Birth Certificate</span>
                                </div>
                                <div class="flex items-center gap-1.5 mt-0.5">
                                    <i data-lucide="file-check" class="w-3 h-3 text-emerald-400"></i>
                                    <span class="text-[10px] text-emerald-400">Report Card (F138)</span>
                                </div>
                            </div>
                            <div class="bg-teal-950/40 border border-teal-500/20 rounded-xl px-3 py-2 flex items-center gap-2">
                                <i data-lucide="send" class="w-3.5 h-3.5 text-teal-400"></i>
                                <span class="text-xs font-bold text-teal-400">Submit for Validation</span>
                            </div>
                        </div>
                    </div>

                    <!-- Phase 2 Preview -->
                    <div class="preview-screen" id="preview-2">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-400 animate-pulse"></span>
                            <span class="text-xs font-bold text-amber-400 uppercase tracking-wider">Phase 2</span>
                        </div>
                        <h3 class="font-display text-xl font-black text-slate-100 mb-1">Payment Verification</h3>
                        <p class="text-xs text-slate-400 mb-5">Finance team verifies the uploaded tuition receipt.</p>
                        <div class="space-y-2.5">
                            <div class="bg-slate-900/60 border border-slate-800 rounded-xl px-3 py-2">
                                <p class="text-[9px] font-bold text-slate-500 uppercase tracking-wider">Receipt Reference</p>
                                <p class="text-xs text-slate-300 font-mono mt-0.5">GCash — 2024-08-1934</p>
                            </div>
                            <div class="bg-slate-900/60 border border-slate-800 rounded-xl px-3 py-2">
                                <p class="text-[9px] font-bold text-slate-500 uppercase tracking-wider">Amount Paid</p>
                                <p class="text-xs text-slate-200 font-bold mt-0.5">₱ 12,500.00</p>
                            </div>
                            <div class="bg-amber-950/40 border border-amber-500/20 rounded-xl px-3 py-2 flex items-center gap-2">
                                <i data-lucide="clock" class="w-3.5 h-3.5 text-amber-400 animate-pulse"></i>
                                <span class="text-xs font-bold text-amber-400">Awaiting Finance Approval</span>
                            </div>
                        </div>
                    </div>

                    <!-- Phase 3 Preview -->
                    <div class="preview-screen" id="preview-3">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                            <span class="text-xs font-bold text-emerald-400 uppercase tracking-wider">Phase 3</span>
                        </div>
                        <h3 class="font-display text-xl font-black text-slate-100 mb-1">Approval & Account</h3>
                        <p class="text-xs text-slate-400 mb-5">Enrollment approved. AMIS ID and Microsoft account generated.</p>
                        <div class="space-y-2.5">
                            <div class="bg-emerald-950/40 border border-emerald-500/20 rounded-xl px-3 py-2 flex items-center gap-2">
                                <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-400"></i>
                                <span class="text-xs font-bold text-emerald-400">Enrollment Approved</span>
                            </div>
                            <div class="bg-slate-900/60 border border-slate-800 rounded-xl px-3 py-2">
                                <p class="text-[9px] font-bold text-slate-500 uppercase tracking-wider">AMIS Student ID</p>
                                <p class="text-xs text-slate-200 font-mono font-bold mt-0.5">AMIS-2024-04821</p>
                            </div>
                            <div class="bg-slate-900/60 border border-slate-800 rounded-xl px-3 py-2">
                                <p class="text-[9px] font-bold text-slate-500 uppercase tracking-wider">Microsoft Account</p>
                                <p class="text-xs text-slate-300 font-medium mt-0.5">ahmad.khalid@amis.edu.ph</p>
                            </div>
                        </div>
                    </div>

                    <!-- Final Preview -->
                    <div class="preview-screen" id="preview-final">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="w-2.5 h-2.5 rounded-full bg-teal-400"></span>
                            <span class="text-xs font-bold text-teal-400 uppercase tracking-wider">Final Output</span>
                        </div>
                        <h3 class="font-display text-xl font-black text-slate-100 mb-1">Enrollment Complete</h3>
                        <p class="text-xs text-slate-400 mb-5">Student can now access the Student Portal and all AMIS systems.</p>
                        <div class="space-y-2.5">
                            <div class="bg-teal-950/40 border border-teal-500/20 rounded-xl px-3 py-3 flex items-center gap-3">
                                <i data-lucide="printer" class="w-4 h-4 text-teal-400 flex-shrink-0"></i>
                                <div>
                                    <p class="text-xs font-bold text-teal-300">Auto Print Enrollment Slip</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">PDF ready for download</p>
                                </div>
                            </div>
                            <div class="bg-emerald-950/40 border border-emerald-500/20 rounded-xl px-3 py-3 flex items-center gap-3">
                                <i data-lucide="layout-dashboard" class="w-4 h-4 text-emerald-400 flex-shrink-0"></i>
                                <div>
                                    <p class="text-xs font-bold text-emerald-300">Access Student Portal</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">student.amis.edu.ph</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /preview-card -->
            </div>

            <!-- RIGHT: Scrollable Phase Details -->
            <div class="lg:w-7/12 space-y-0" id="phaseTimeline">

                <!-- ── Phase 1 ── -->
                <div class="phase-block" data-phase="1">
                    <div class="phase-card" id="phaseCard1">
                        <div class="flex items-start gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-teal-950/60 border border-teal-500/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i data-lucide="user-plus" class="w-4 h-4 text-teal-400"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap mb-0.5">
                                    <span class="text-[9px] font-black text-teal-400 uppercase tracking-widest">Phase 1</span>
                                    <span class="timeline-badge"><i data-lucide="calendar" class="w-3 h-3"></i> Aug 1–15, 2024</span>
                                </div>
                                <h3 class="font-display text-xl font-black text-slate-100">Student Registration</h3>
                            </div>
                            <span class="text-xs font-bold text-emerald-400 bg-emerald-950/30 border border-emerald-500/15 px-2.5 py-1 rounded-full flex-shrink-0">100%</span>
                        </div>
                        <div class="space-y-3 pl-1">
                            <div class="step-row" data-delay="0">
                                <div class="w-6 h-6 rounded-full bg-emerald-950/60 border border-emerald-500/25 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i data-lucide="check" class="w-3 h-3 text-emerald-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-200">Student Sign-In</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Microsoft or Google SSO authentication via @amis.edu.ph</p>
                                </div>
                            </div>
                            <div class="step-row" data-delay="100">
                                <div class="w-6 h-6 rounded-full bg-emerald-950/60 border border-emerald-500/25 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i data-lucide="check" class="w-3 h-3 text-emerald-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-200">Profile Form</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Personal info, grade level, curriculum selection, guardian details</p>
                                </div>
                            </div>
                            <div class="step-row" data-delay="200">
                                <div class="w-6 h-6 rounded-full bg-emerald-950/60 border border-emerald-500/25 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i data-lucide="check" class="w-3 h-3 text-emerald-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-200">Upload Documents</p>
                                    <p class="text-xs text-slate-500 mt-0.5">PSA birth certificate, F138 report card, and 2x2 photo</p>
                                </div>
                            </div>
                            <div class="step-row" data-delay="300">
                                <div class="w-6 h-6 rounded-full bg-emerald-950/60 border border-emerald-500/25 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i data-lucide="check" class="w-3 h-3 text-emerald-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-200">Registration Validation</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Registrar reviews submitted data and approves application</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Connector 1→2 -->
                <div class="flex justify-center py-3">
                    <div class="phase-connector-wrap" id="conn-1-2">
                        <div class="phase-connector"></div>
                        <div class="arrow-chevron">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>
                </div>

                <!-- ── Phase 2 ── -->
                <div class="phase-block" data-phase="2">
                    <div class="phase-card" id="phaseCard2">
                        <div class="flex items-start gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-amber-950/60 border border-amber-500/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i data-lucide="credit-card" class="w-4 h-4 text-amber-400"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap mb-0.5">
                                    <span class="text-[9px] font-black text-amber-400 uppercase tracking-widest">Phase 2</span>
                                    <span class="timeline-badge"><i data-lucide="calendar" class="w-3 h-3"></i> Aug 16–25, 2024</span>
                                </div>
                                <h3 class="font-display text-xl font-black text-slate-100">Payment Verification</h3>
                            </div>
                            <span class="text-xs font-bold text-emerald-400 bg-emerald-950/30 border border-emerald-500/15 px-2.5 py-1 rounded-full flex-shrink-0">100%</span>
                        </div>
                        <div class="space-y-3 pl-1">
                            <div class="step-row" data-delay="0">
                                <div class="w-6 h-6 rounded-full bg-emerald-950/60 border border-emerald-500/25 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i data-lucide="check" class="w-3 h-3 text-emerald-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-200">Upload Tuition Receipt</p>
                                    <p class="text-xs text-slate-500 mt-0.5">GCash, Maya, or bank deposit slip with reference number</p>
                                </div>
                            </div>
                            <div class="step-row" data-delay="100">
                                <div class="w-6 h-6 rounded-full bg-emerald-950/60 border border-emerald-500/25 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i data-lucide="check" class="w-3 h-3 text-emerald-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-200">Finance Checks Payment</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Finance team validates receipt against bank records</p>
                                </div>
                            </div>
                            <div class="step-row" data-delay="200">
                                <div class="w-6 h-6 rounded-full bg-emerald-950/60 border border-emerald-500/25 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i data-lucide="check" class="w-3 h-3 text-emerald-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-200">Admin Approves Payment</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Admin portal marks payment as verified, triggers next phase</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Connector 2→3 -->
                <div class="flex justify-center py-3">
                    <div class="phase-connector-wrap" id="conn-2-3">
                        <div class="phase-connector"></div>
                        <div class="arrow-chevron">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>
                </div>

                <!-- ── Phase 3 ── -->
                <div class="phase-block" data-phase="3">
                    <div class="phase-card" id="phaseCard3">
                        <div class="flex items-start gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-emerald-950/60 border border-emerald-500/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i data-lucide="shield-check" class="w-4 h-4 text-emerald-400"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap mb-0.5">
                                    <span class="text-[9px] font-black text-emerald-400 uppercase tracking-widest">Phase 3</span>
                                    <span class="timeline-badge"><i data-lucide="calendar" class="w-3 h-3"></i> Aug 26–31, 2024</span>
                                </div>
                                <h3 class="font-display text-xl font-black text-slate-100">Approval & Account Generation</h3>
                            </div>
                            <span class="text-xs font-bold text-emerald-400 bg-emerald-950/30 border border-emerald-500/15 px-2.5 py-1 rounded-full flex-shrink-0">100%</span>
                        </div>
                        <div class="space-y-3 pl-1">
                            <div class="step-row" data-delay="0">
                                <div class="w-6 h-6 rounded-full bg-emerald-950/60 border border-emerald-500/25 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i data-lucide="check" class="w-3 h-3 text-emerald-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-200">Enrollment Approved</p>
                                    <p class="text-xs text-slate-500 mt-0.5">System marks student status as "Officially Enrolled"</p>
                                </div>
                            </div>
                            <div class="step-row" data-delay="100">
                                <div class="w-6 h-6 rounded-full bg-emerald-950/60 border border-emerald-500/25 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i data-lucide="check" class="w-3 h-3 text-emerald-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-200">AMIS ID Generated</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Unique school ID assigned — <span class="font-mono text-teal-400">AMIS-2024-XXXXX</span></p>
                                </div>
                            </div>
                            <div class="step-row" data-delay="200">
                                <div class="w-6 h-6 rounded-full bg-emerald-950/60 border border-emerald-500/25 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i data-lucide="check" class="w-3 h-3 text-emerald-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-200">Microsoft Account Created</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Graph API provisions <span class="font-mono text-teal-400">firstname.lastname@amis.edu.ph</span></p>
                                </div>
                            </div>
                            <div class="step-row" data-delay="300">
                                <div class="w-6 h-6 rounded-full bg-emerald-950/60 border border-emerald-500/25 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i data-lucide="check" class="w-3 h-3 text-emerald-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-200">Welcome Email Sent</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Onboarding email with credentials, schedule, and portal links</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Connector 3→Final -->
                <div class="flex justify-center py-3">
                    <div class="phase-connector-wrap" id="conn-3-f">
                        <div class="phase-connector" style="background:linear-gradient(180deg,rgba(16,185,129,0.5),rgba(16,185,129,0.1));"></div>
                        <div class="arrow-chevron" style="background:rgba(16,185,129,0.12);border-color:rgba(16,185,129,0.3);">
                            <i data-lucide="chevron-down" class="w-4 h-4" style="color:#10b981;"></i>
                        </div>
                    </div>
                </div>

                <!-- ── Final Output ── -->
                <div class="phase-block" data-phase="final">
                    <div class="phase-card" id="phaseCardFinal">
                        <div class="flex items-start gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-teal-950/60 border border-teal-500/25 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i data-lucide="party-popper" class="w-4 h-4 text-teal-400"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap mb-0.5">
                                    <span class="text-[9px] font-black text-teal-400 uppercase tracking-widest">Final Output</span>
                                    <span class="timeline-badge" style="border-color:rgba(20,184,166,0.2);color:#14b8a6;"><i data-lucide="calendar-check" class="w-3 h-3"></i> Sep 1, 2024 onwards</span>
                                </div>
                                <h3 class="font-display text-xl font-black text-slate-100">Enrollment Complete</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="step-row items-start" data-delay="0" style="flex-direction:column;gap:0.5rem;">
                                <div class="bg-teal-950/50 border border-teal-500/20 rounded-xl p-3.5 w-full flex items-center gap-3">
                                    <i data-lucide="printer" class="w-5 h-5 text-teal-400 flex-shrink-0"></i>
                                    <div>
                                        <p class="text-xs font-bold text-teal-300">Auto Print Enrollment Slip</p>
                                        <p class="text-[10px] text-slate-400 mt-0.5">PDF auto-generated and ready to download</p>
                                    </div>
                                </div>
                            </div>
                            <div class="step-row items-start" data-delay="150" style="flex-direction:column;gap:0.5rem;">
                                <div class="bg-emerald-950/50 border border-emerald-500/20 rounded-xl p-3.5 w-full flex items-center gap-3">
                                    <i data-lucide="layout-dashboard" class="w-5 h-5 text-emerald-400 flex-shrink-0"></i>
                                    <div>
                                        <p class="text-xs font-bold text-emerald-300">Access Student Portal</p>
                                        <p class="text-[10px] text-slate-400 mt-0.5">student.amis.edu.ph — full access unlocked</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /right column -->
        </div><!-- /sticky layout wrapper -->
    </section>

    <!-- footer spacer -->
    <div class="h-24"></div>

    <!-- ═══════════ SCRIPTS ═══════════ -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();

        /* ── Counter animation ── */
        function countUp(el, target, duration = 900) {
            let start = null;
            const step = ts => {
                if (!start) start = ts;
                const p = Math.min((ts - start) / duration, 1);
                el.textContent = Math.floor(p * target) + '%';
                if (p < 1) requestAnimationFrame(step);
            };
            requestAnimationFrame(step);
        }

        /* ── Generic observer helper ── */
        function observe(selector, callback, opts = {}) {
            const io = new IntersectionObserver((entries, obs) => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        callback(e.target, obs);
                    }
                });
            }, { threshold: 0.18, ...opts });
            document.querySelectorAll(selector).forEach(el => io.observe(el));
        }

        /* ── Portal card nodes ── */
        observe('.node-hidden', (el, obs) => {
            el.classList.add('visible');
            // count badges inside node
            el.querySelectorAll('.count-badge[data-target]').forEach(badge => {
                countUp(badge, parseInt(badge.dataset.target));
            });
            // stagger check icons
            const checks = el.querySelectorAll('.check-pop');
            checks.forEach((c, i) => setTimeout(() => c.classList.add('visible'), i * 110));
            obs.unobserve(el);
        });

        observe('.final-node', (el, obs) => {
            el.classList.add('visible');
            obs.unobserve(el);
        });

        observe('.connector', (el, obs) => {
            el.classList.add('visible');
            obs.unobserve(el);
        });

        /* ── Enrollment phase cards ── */
        const phaseOrder = ['1','2','3','final'];
        let completedPhases = new Set();

        function setPreview(phase) {
            document.querySelectorAll('.preview-screen').forEach(s => s.classList.remove('active'));
            const target = document.getElementById('preview-' + phase);
            if (target) target.classList.add('active');
        }

        function activateCard(cardEl, phase) {
            // Mark previous phases as done
            phaseOrder.slice(0, phaseOrder.indexOf(phase)).forEach(p => {
                const c = document.getElementById('phaseCard' + (p === 'final' ? 'Final' : p));
                if (c) { c.classList.remove('active-phase'); c.classList.add('done-phase'); }
            });

            cardEl.classList.remove('done-phase');
            cardEl.classList.add('active-phase');
            setPreview(phase);
        }

        // Observe each phase card
        phaseOrder.forEach(phase => {
            const cardId = 'phaseCard' + (phase === 'final' ? 'Final' : phase);
            const card = document.getElementById(cardId);
            if (!card) return;

            const io = new IntersectionObserver(entries => {
                entries.forEach(e => {
                    if (e.isIntersecting && !completedPhases.has(phase)) {
                        // 1. Animate card in
                        card.classList.add('visible');
                        activateCard(card, phase);

                        // 2. Animate step rows with stagger
                        const steps = card.querySelectorAll('.step-row');
                        steps.forEach((s, i) => {
                            const delay = parseInt(s.dataset.delay || 0) + i * 120;
                            setTimeout(() => s.classList.add('visible'), delay + 200);
                        });

                        // 3. Draw connector going OUT of this phase
                        const connMap = { '1': 'conn-1-2', '2': 'conn-2-3', '3': 'conn-3-f' };
                        if (connMap[phase]) {
                            setTimeout(() => {
                                const conn = document.getElementById(connMap[phase]);
                                if (conn) conn.classList.add('visible');
                            }, 700);
                        }

                        completedPhases.add(phase);
                    }
                });
            }, { threshold: 0.22, rootMargin: '0px 0px -10% 0px' });

            io.observe(card);
        });

        // Also keep left preview in sync on scroll (for already-passed phases)
        const phaseBlocks = document.querySelectorAll('.phase-block');
        const previewSync = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    const phase = e.target.dataset.phase;
                    setPreview(phase);
                }
            });
        }, { threshold: 0.5 });
        phaseBlocks.forEach(b => previewSync.observe(b));
    });
    </script>
</body>
</html>
