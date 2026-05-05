<!-- app/views/dashboard/ai_insights.php -->
<div class="section-header">
    <h1>AI Insights Lab</h1>
    <p>Exploring data trends for: <strong style="color: #E63946;"><?= $topic ?></strong></p>
    <!-- VULNERABILITY: Reflected XSS here -->
</div>

<div style="max-width: 900px; margin: 0 auto 5rem; padding: 0 5%;">
    <div style="background: white; padding: 3rem; border-radius: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.05);">
        <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 2rem; padding: 1.5rem; background: #fdfcdc; border-radius: 20px;">
            <div style="font-size: 2.5rem;">🤖</div>
            <div>
                <h3 style="margin-bottom: 0.5rem;">AI Summary for <?= htmlspecialchars($topic) ?></h3>
                <p style="font-size: 0.9rem; color: #666; line-height: 1.6;">Our neural networks have analyzed thousands of data points regarding <strong><?= htmlspecialchars($topic) ?></strong>. The overall sentiment is highly positive, with a focus on fresh ingredients and artistic presentation.</p>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div style="border: 1px solid #eee; padding: 1.5rem; border-radius: 20px;">
                <h4 style="margin-bottom: 1rem;"><i class="fa fa-chart-line" style="color: #E63946;"></i> Trend Analysis</h4>
                <p style="font-size: 0.85rem; color: #888;">Mentioned 15% more this week compared to last month. Peak interest at 8 PM daily.</p>
            </div>
            <div style="border: 1px solid #eee; padding: 1.5rem; border-radius: 20px;">
                <h4 style="margin-bottom: 1rem;"><i class="fa fa-bolt" style="color: #F4A261;"></i> Key Sentiment</h4>
                <p style="font-size: 0.85rem; color: #888;">"Coastal flavor", "Artisanal bun", and "Quick service" are the top-rated keywords.</p>
            </div>
        </div>

        <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px dashed #eee; text-align: center;">
            <a href="/" style="color: #E63946; text-decoration: none; font-weight: 600;">&larr; Back to Dashboard</a>
        </div>
    </div>
</div>
