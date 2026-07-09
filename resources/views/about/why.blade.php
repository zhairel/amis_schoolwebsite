@extends('layouts.app')

@section('title', 'Why Islamic School? | AMIS')

@section('styles')
<style>
    .why-islamic-school {
        min-height: 100vh;
    }
    .breadcrumb-header {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        padding: 20px 0;
        margin-top: 0;
        position: relative;
        top: 0;
    }
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        color: white;
        font-size: 0.9rem;
    }
    .breadcrumb a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: color 0.2s;
    }
    .breadcrumb a:hover {
        color: white;
    }
    .breadcrumb .separator {
        color: rgba(255, 255, 255, 0.6);
    }
    .page-title {
        font-size: 3rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 16px;
        color: var(--text);
        margin-top: 40px;
    }
    .page-subtitle {
        text-align: center;
        color: var(--text-light);
        font-size: 1.25rem;
        margin-bottom: 60px;
    }
    .comparison-table {
        margin-bottom: 60px;
        overflow-x: auto;
        padding-bottom: 20px;
    }
    .comparison-table table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid #d1d5db;
    }
    .comparison-table th {
        padding: 20px;
        text-align: center;
        font-size: 1.1rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: 1px solid #d1d5db;
        color: #1f2937;
        background: white;
    }
    .comparison-table th:first-child {
        background: #059669;
        border: 1px solid #047857;
        color: white;
    }
    .comparison-table th:nth-child(2) {
        background: #059669;
        border: 1px solid #047857;
        color: white;
    }
    .comparison-table td {
        padding: 18px 20px;
        border: 1px solid #d1d5db;
        font-size: 1rem;
        line-height: 1.6;
        vertical-align: top;
        color: #1f2937;
    }
    .comparison-table tbody tr:nth-child(even) {
        background: #f9fafb;
    }
    .comparison-table tbody tr:hover {
        background: #f0fdf4;
    }
    .comparison-table .category {
        font-weight: 700;
        color: #1f2937;
        background: #f3f4f6;
        width: 180px;
        text-align: left;
    }
    .comparison-table .islamic-col {
        background: #ecfdf5;
        color: #1f2937;
        font-weight: 500;
    }
    .islamic-quote {
        background: white;
        padding: 50px 40px;
        border-radius: 16px;
        border-left: 6px solid #dc2626;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 80px;
    }
    .quote-text {
        font-size: 1.15rem;
        line-height: 1.8;
        color: #dc2626;
        font-style: italic;
        margin-bottom: 30px;
        font-weight: 500;
    }
    .quote-source {
        border-top: 2px solid var(--border);
        padding-top: 20px;
    }
    .source-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 12px;
    }
    .scholars {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 8px;
        margin-bottom: 16px;
    }
    .scholars div {
        font-size: 0.95rem;
        color: var(--text-light);
        font-weight: 500;
    }
    .reference {
        font-size: 0.9rem;
        color: var(--text-lighter);
        font-style: italic;
    }
    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }
        .page-subtitle {
            font-size: 1rem;
        }
        .comparison-table {
            font-size: 0.9rem;
        }
        .comparison-table th,
        .comparison-table td {
            padding: 12px;
        }
        .comparison-table .category {
            width: auto;
        }
        .islamic-quote {
            padding: 30px 20px;
        }
        .quote-text {
            font-size: 1rem;
        }
        .scholars {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="why-islamic-school">
    <!-- Breadcrumb Header -->
    <div class="breadcrumb-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span class="separator">/</span>
                <a href="{{ route('about.index') }}">About Us</a>
                <span class="separator">/</span>
                <span>Why Islamic School?</span>
            </div>
        </div>
    </div>

    <!-- Section Content -->
    <section class="section">
        <div class="container">
            <h1 class="page-title">Why Islamic School?</h1>
            <p class="page-subtitle">Discover the unique benefits of Islamic education</p>

            <div class="comparison-table">
                <table>
                    <thead>
                        <tr>
                            <th>DIFFERENCE</th>
                            <th class="islamic-col">ISLAMIC SCHOOL</th>
                            <th>OTHER PRIVATE / PUBLIC SCHOOL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="category">During Assembly</td>
                            <td class="islamic-col">Utter Shahada, Recite Qur'an, Hadith</td>
                            <td>Read other prayer</td>
                        </tr>
                        <tr>
                            <td class="category" rowspan="2">Classroom</td>
                            <td class="islamic-col">Study Islamic subjects, Qur'an, Seerah, Hadith, Aqeedah, Fiqh, Arabic, English, Math, Science, Filipino, etc.</td>
                            <td>Study English, Math, Science, Filipino, etc and some minutes only Islamic studies.</td>
                        </tr>
                        <tr>
                            <td class="islamic-col">Recite Qur'an and Hadith</td>
                            <td>Read other prayer</td>
                        </tr>
                        <tr>
                            <td class="category">Gender Structure</td>
                            <td class="islamic-col">Secondary: separate boys and girls</td>
                            <td>No separation of boys and girls</td>
                        </tr>
                        <tr>
                            <td class="category">Noon Break</td>
                            <td class="islamic-col">Lunch and perform Dhuhor prayer</td>
                            <td>Lunch</td>
                        </tr>
                        <tr>
                            <td class="category">Food in Canteen</td>
                            <td class="islamic-col">Halal non-pork</td>
                            <td>Mix</td>
                        </tr>
                        <tr>
                            <td class="category">Mid-afternoon</td>
                            <td class="islamic-col">Perform Asar Prayer</td>
                            <td>None</td>
                        </tr>
                        <tr>
                            <td class="category" rowspan="2">Program/Activities</td>
                            <td class="islamic-col">Start with reading of Qur'an and du'a</td>
                            <td>Start with other prayer</td>
                        </tr>
                        <tr>
                            <td class="islamic-col">Does not violate Islamic rules</td>
                            <td>Any activities</td>
                        </tr>
                        <tr>
                            <td class="category">Jum'a Prayer</td>
                            <td class="islamic-col">Join Jum'a prayer in school Masjid</td>
                            <td>No Jum'a Prayer</td>
                        </tr>
                        <tr>
                            <td class="category">School Uniform</td>
                            <td class="islamic-col">Proper Islamic attire - Hijab</td>
                            <td>Non-Hijab</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="islamic-quote">
                <p class="quote-text">"It is obligatory upon the father that he cultivates his offspring – whether they are male or female with an Islamic cultivation. For they are a trust in his hand; and he will be responsible for them on The Day of Judgement. Thus it is impermissible for him to enter them into the schools of the disbelievers for fear of fitnah (trial) and of the corruption of some belief as well as mannerism/behavior."</p>
                <div class="quote-source">
                    <div class="source-title">Permanent Committee for Research and Verdicts</div>
                    <div class="scholars">
                        <div>Shaykh 'Abdul-'Azeez Bin Baz</div>
                        <div>Shaykh 'Abdullah bin Ghudayaan</div>
                        <div>Shaykh 'Abdullaah bin Qu'ood</div>
                        <div>Shaykh 'Abdul-Razzaaq al-'Afeefee</div>
                    </div>
                    <div class="reference">Fataawaa Al-Lajnah ad-daa'imah vol. 12 page 141 question eight of fatwa number 4172</div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
