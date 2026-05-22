-- ════════════════════════════════════════════════════════════
-- Maintenance Mode Migration
-- Run this in Supabase SQL Editor
-- ════════════════════════════════════════════════════════════

-- Add maintenance columns to settings table
ALTER TABLE settings
  ADD COLUMN IF NOT EXISTS maintenance_mode    BOOLEAN DEFAULT FALSE,
  ADD COLUMN IF NOT EXISTS maintenance_message TEXT    DEFAULT '';

-- Reviews: Allow public insert (so customers can submit reviews)
DO $$
BEGIN
  IF NOT EXISTS (
    SELECT 1 FROM pg_policies WHERE tablename = 'reviews' AND policyname = 'Allow public insert reviews'
  ) THEN
    CREATE POLICY "Allow public insert reviews"
      ON reviews FOR INSERT
      WITH CHECK (true);
  END IF;
END
$$;

-- Reviews: Allow reading approved reviews without auth
DO $$
BEGIN
  IF NOT EXISTS (
    SELECT 1 FROM pg_policies WHERE tablename = 'reviews' AND policyname = 'Allow public read approved reviews'
  ) THEN
    CREATE POLICY "Allow public read approved reviews"
      ON reviews FOR SELECT
      USING (is_approved = true);
  END IF;
END
$$;

-- home_sections table (if not already created)
CREATE TABLE IF NOT EXISTS home_sections (
  id           UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  title        TEXT NOT NULL,
  type         TEXT NOT NULL DEFAULT 'category',
  category_id  UUID REFERENCES categories(id) ON DELETE SET NULL,
  product_ids  JSONB DEFAULT '[]',
  max_products INTEGER DEFAULT 10,
  sort_order   INTEGER DEFAULT 0,
  is_active    BOOLEAN DEFAULT TRUE,
  created_at   TIMESTAMPTZ DEFAULT NOW()
);

-- Review ImgBB key column
ALTER TABLE settings
  ADD COLUMN IF NOT EXISTS review_imgbb_key TEXT DEFAULT '';
