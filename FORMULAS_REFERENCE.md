# Virtual Lab Formulas Reference

## Physics Lab

### Simple Pendulum
**Formula**: T = 2π√(L/g)
- T = Period (seconds)
- L = Length of pendulum (meters)
- g = Gravitational acceleration (9.81 m/s²)
- π = Pi (3.14159...)

**Frequency**: f = 1/T (Hz)

### Projectile Motion
**Time of Flight**: t = 2v₀sin(θ)/g
- t = Time (seconds)
- v₀ = Initial velocity (m/s)
- θ = Launch angle (radians)
- g = 9.81 m/s²

**Maximum Height**: h = (v₀²sin²(θ))/(2g)
- h = Height (meters)

**Range**: R = (v₀²sin(2θ))/g
- R = Horizontal distance (meters)

### Free Fall
**Time**: t = √(2h/g)
- t = Time to fall (seconds)
- h = Initial height (meters)
- g = 9.81 m/s²

**Final Velocity**: v = gt
- v = Final velocity (m/s)

---

## Math Lab

### Quadratic Equation
**Standard Form**: ax² + bx + c = 0

**Discriminant**: Δ = b² - 4ac

**Roots**:
- If Δ > 0: Two distinct real roots
  - x₁ = (-b + √Δ)/(2a)
  - x₂ = (-b - √Δ)/(2a)

- If Δ = 0: One repeated real root
  - x = -b/(2a)

- If Δ < 0: Two complex conjugate roots
  - x₁ = (-b/(2a)) + i(√|Δ|/(2a))
  - x₂ = (-b/(2a)) - i(√|Δ|/(2a))

### Matrix Operations (2×2)

**Addition**: [a b; c d] + [e f; g h] = [a+e b+f; c+g d+h]

**Subtraction**: [a b; c d] - [e f; g h] = [a-e b-f; c-g d-h]

**Multiplication**: [a b; c d] × [e f; g h] = [ae+bg af+bh; ce+dg cf+dh]

### Statistics

**Mean (μ)**: μ = (Σx)/n
- Sum of all values divided by count

**Median**: 
- Sort data, take middle value
- If even count: average of two middle values

**Standard Deviation (σ)**: σ = √(Σ(x-μ)²/n)
- Measures spread of data around mean

---

## Chemistry Lab

### Molarity
**Formula**: M = n/V
- M = Molarity (mol/L or M)
- n = Moles of solute
- V = Volume of solution (liters)

### pH Scale
**pH**: pH = -log₁₀[H⁺]
- pH < 7: Acidic
- pH = 7: Neutral
- pH > 7: Basic

**pOH**: pOH = 14 - pH

**Relationship**: [H⁺] × [OH⁻] = 10⁻¹⁴

### Ideal Gas Law
**Formula**: PV = nRT
- P = Pressure (atm)
- V = Volume (liters)
- n = Moles of gas
- R = Gas constant (0.0821 L·atm/(mol·K))
- T = Temperature (Kelvin)

**Solving for n**: n = PV/(RT)

**Temperature Conversions**:
- K = °C + 273.15
- °C = K - 273.15

### Stoichiometry
**Steps**:
1. Convert mass to moles: n = mass/molar_mass
2. Apply mole ratio: n_product = n_reactant × ratio
3. Convert moles to mass: mass = n × molar_mass

**Example**: 2H₂ + O₂ → 2H₂O
- Mole ratio H₂:H₂O = 2:2 = 1:1
- Mole ratio O₂:H₂O = 1:2 = 0.5:1

---

## Constants Used

- **g** (gravity): 9.81 m/s²
- **R** (gas constant): 0.0821 L·atm/(mol·K)
- **π** (pi): 3.14159265359
- **e** (euler): 2.71828182846

---

## Unit Conversions

### Temperature
- Celsius to Kelvin: K = °C + 273.15
- Fahrenheit to Celsius: °C = (°F - 32) × 5/9

### Pressure
- 1 atm = 101.325 kPa
- 1 atm = 760 mmHg (torr)

### Volume
- 1 L = 1000 mL
- 1 L = 1 dm³

### Mass
- 1 kg = 1000 g
- 1 g = 1000 mg
