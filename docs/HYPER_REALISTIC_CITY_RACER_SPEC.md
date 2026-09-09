# Hyper-Realistic City Racer — Prototype Specification

## Vision
Create a fictional, hyper-realistic third-person open-world driving game scene set in a modern city at sunset. The experience should feel like a AAA open-world racing/action game while using fully original characters, vehicles, environments, UI, audio, and branding.

## Core Sequence
1. **Cinematic launch** — Third-person chase camera settles behind the player's sports car as sunset light reflects from glass towers and wet-looking asphalt.
2. **Traffic sprint** — Player accelerates through dense but believable urban traffic, avoiding civilian vehicles with responsive steering and braking.
3. **Technical driving** — Tight intersections, sharp turns, lane changes, controlled drifts, tire grip changes, suspension motion, and believable collision avoidance.
4. **Escalation** — A fictional heat/wanted meter rises as the player performs risky driving. Traffic becomes more challenging but remains readable and fair.
5. **Dynamic camera work** — Blend standard third-person chase, low bumper-level shots, wheel close-ups, and a short dramatic slow-motion camera during the largest drift.
6. **Escape** — The player reaches a rooftop parking deck, performs a controlled stop, and ends on a wide skyline shot with the city glowing in the sunset.

## Environment
- Modern fictional city with dense mid-rise and high-rise buildings.
- Busy avenues, side streets, intersections, parking structures, storefronts, traffic lights, road markings, signs, barriers, street furniture, and realistic pedestrian navigation.
- Natural sunset illumination, long shadows, realistic indirect light, physically plausible reflections, glass highlights, subtle atmospheric haze, and detailed material surfaces.
- Environmental storytelling through shop windows, parked vehicles, construction details, rooftop equipment, and varied architecture.

## Vehicle & Physics
- Original fictional high-performance sports coupe; no real-world trademarked vehicle branding.
- Physically based acceleration, braking, weight transfer, suspension compression, tire grip, steering response, drivetrain behavior, and controlled oversteer.
- Tire smoke and dust generated from wheel slip and surface interaction rather than constant particle effects.
- Vehicle paint, glass, rubber, metal, lights, and brake discs use high-resolution PBR materials.

## Player & Pedestrians
- Original young adult street-racer protagonist with non-identifying appearance and fictional clothing.
- Pedestrians use varied animations, crossing logic, sidewalk avoidance, and believable reactions to nearby traffic.
- No real-person likenesses.

## HUD
- Speedometer with km/h display.
- Compact mini-map with route guidance.
- Mission objective: `ESCAPE THE CITY TRAFFIC`.
- Fictional 5-level heat meter that rises from dangerous driving and falls after sustained clean driving.
- Minimal reticle/interaction elements only where necessary; preserve cinematic readability.

## Audio
- Layered fictional engine note with RPM-based pitch, throttle response, gear changes, intake, exhaust, and drivetrain vibration.
- Tire screeches/scrub tied to slip angle and speed.
- Spatial city ambience: traffic, horns, distant sirens, pedestrian chatter, ventilation, construction, and intersection signals.
- Cinematic royalty-free/original background score that builds during the escape and resolves at the rooftop stop.

## Rendering & Camera Targets
- Photorealistic presentation with physically based rendering.
- 4K target assets where feasible, high-resolution textures, detailed geometry, realistic reflections and shadows, temporal anti-aliasing, depth of field, motion blur used sparingly, volumetric atmosphere, and high frame-rate gameplay.
- Camera should communicate speed without becoming nauseating: subtle shake under hard acceleration, controlled roll in corners, and brief slow motion only at the signature drift.

## Scene Direction Prompt
> A hyper-realistic fictional AAA open-world driving game scene at sunset in a modern metropolitan city. A young adult fictional street racer drives an original high-performance sports coupe through busy urban streets. Begin in a cinematic third-person chase camera directly behind the vehicle. The player accelerates through realistic traffic, narrowly avoids civilian cars, takes sharp corners, performs controlled drifts, and escapes through detailed city blocks. Show believable pedestrians, traffic lights, storefronts, road signs, lane markings, glass towers, reflections, shadows, dust, tire smoke, suspension movement, brake glow, and natural atmospheric haze. Include a polished game HUD with speed in km/h, a mini-map, mission objective, and a fictional five-level heat meter. Use dynamic camera transitions between chase view, low road-level angles, close wheel shots, and a dramatic but brief slow-motion angle during the biggest drift. Audio should feel immersive: original engine sounds, tire screeches, city traffic ambience, distant sirens, and cinematic background music. Maintain physically plausible vehicle handling and traffic behavior. End with a successful escape and a dramatic controlled stop in a rooftop parking area overlooking the sunset city skyline. Photorealistic, ultra-detailed, natural lighting, physically based materials, realistic reflections, cinematic depth of field, 4K-quality assets, high frame rate, AAA open-world presentation.

## Implementation Notes
- Prefer original/fantasy assets and avoid copying recognizable game characters, maps, interfaces, or copyrighted music.
- Build the first milestone as a vertical slice: one city block loop, one vehicle, a small traffic pool, basic pedestrians, HUD, heat system, and rooftop destination.
- Add optimization passes before expanding world density: level-of-detail meshes, occlusion culling, pooled traffic/pedestrian actors, baked/streamed world sectors, and scalable reflection/volumetric settings.
