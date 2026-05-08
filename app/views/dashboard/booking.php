<!-- app/views/dashboard/booking.php -->
<div class="section-header">
    <h1>Reserve a Table</h1>
    <p>Secure your spot at the Lab for a premium burger experience.</p>
</div>

<div style="max-width: 600px; margin: 0 auto 5rem; padding: 0 5%;">
    <div style="background: white; padding: 3rem; border-radius: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.05);">
        <form action="/booking" method="POST">
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #555;">Your Name</label>
                <input type="text" name="name" placeholder="Kiran Vijayan" class="glass-input" required>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #555;">Date</label>
                    <input type="date" name="date" class="glass-input" required>
                </div>
                <div>
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #555;">Time</label>
                    <input type="time" name="time" class="glass-input" required>
                </div>
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #555;">Number of Guests</label>
                <select name="guests" class="glass-input" required>
                    <option value="1">1 Person</option>
                    <option value="2">2 People</option>
                    <option value="4">4 People</option>
                    <option value="6">6+ People</option>
                </select>
            </div>
            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #555;">Special Requests</label>
                <textarea name="notes" placeholder="e.g. Birthday celebration, window seat..." class="glass-input" style="height: 100px;"></textarea>
            </div>
            <button type="submit" class="btn-primary" style="width: 100%; padding: 1rem; border-radius: 15px;">Confirm Reservation</button>
        </form>
    </div>
</div>
