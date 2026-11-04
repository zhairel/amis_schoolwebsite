<!-- Islamic Prayer Times & Daily Guidance Modal -->
<div class="prayer-modal-overlay" id="prayerModal" style="display: none;" role="dialog" aria-modal="true" aria-labelledby="prayerModalTitle">
    <div class="prayer-modal-dialog">
        <!-- Modal Header -->
        <div class="prayer-modal-header">
            <div class="header-titles">
                <span class="header-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    Davao City, Philippines (GMT+8)
                </span>
                <h3 id="prayerModalTitle" class="prayer-modal-title">Davao Daily Salah Schedule</h3>
                <div class="prayer-hijri-sub">
                    <span class="hijri-en">{{ $hijriDate['formatted_en'] ?? '16 Jumada al-Awwal 1448 AH' }}</span>
                    <span class="hijri-sep">•</span>
                    <span class="hijri-ar" dir="rtl">{{ $hijriDate['formatted_ar'] ?? '' }}</span>
                </div>
            </div>
            <button type="button" class="prayer-modal-close" id="closePrayerModal" aria-label="Close Prayer Schedule">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Next Prayer Hero Strip -->
        <div class="next-prayer-strip">
            <div class="strip-left">
                <span class="strip-pulse-indicator"></span>
                <div>
                    <span class="strip-sublabel">Next Upcoming Prayer</span>
                    <div class="strip-prayer-name">
                        {{ $prayerStatus['next_name'] ?? 'Salah' }}
                        <span class="strip-arabic">({{ $prayerStatus['next_arabic'] ?? '' }})</span>
                    </div>
                </div>
            </div>
            <div class="strip-right">
                <div class="strip-time">{{ $prayerStatus['next_time'] ?? '' }}</div>
                <div class="strip-countdown">in {{ $prayerStatus['countdown'] ?? '' }}</div>
            </div>
        </div>

        <!-- 6 Timings Grid -->
        <div class="prayer-timings-grid">
            @foreach($prayerStatus['prayers'] as $key => $prayer)
                @php
                    $isActive = ($prayerStatus['current'] === $key);
                    $isNext = ($prayerStatus['next'] === $key);
                @endphp
                <div class="prayer-card {{ $isActive ? 'active-prayer' : '' }} {{ $isNext ? 'next-prayer' : '' }}">
                    <div class="prayer-card-header">
                        <span class="prayer-name">{{ $prayer['name'] }}</span>
                        <span class="prayer-arabic" dir="rtl">{{ $prayer['arabic'] }}</span>
                    </div>
                    <div class="prayer-time">{{ $prayer['time_str'] }}</div>
                    <div class="prayer-status-tag">
                        @if($isActive)
                            <span class="tag-badge tag-active">Active Now</span>
                        @elseif($isNext)
                            <span class="tag-badge tag-next">Next</span>
                        @else
                            <span class="tag-badge tag-muted">Scheduled</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Daily Quranic Ayah / Guidance -->
        @if(!empty($dailyAyah))
            <div class="prayer-daily-reflection">
                <div class="reflection-header">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span>Daily Islamic Reflection</span>
                </div>
                <div class="reflection-arabic" dir="rtl">
                    {{ $dailyAyah['arabic'] }}
                </div>
                <div class="reflection-translation">
                    "{{ $dailyAyah['translation'] }}"
                </div>
                <div class="reflection-ref">
                    {{ $dailyAyah['reference'] }}
                </div>
            </div>
        @endif

        <!-- Footer Note -->
        <div class="prayer-modal-footer">
            <p>
                Calculated for <strong>Davao City Campus (7.07° N, 125.61° E)</strong> • Standard Shafi'i / Maliki / Hanbali Asr rule.
                Faculty & students observe congregational prayers at the School Musalla.
            </p>
        </div>
    </div>
</div>
