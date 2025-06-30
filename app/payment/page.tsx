"use client"

import { useState } from "react"
import { Button } from "@/components/ui/button"
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Badge } from "@/components/ui/badge"
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs"
import {
  ArrowLeft,
  CreditCard,
  Zap,
  Droplets,
  Phone,
  Wifi,
  Car,
  ShoppingBag,
  QrCode,
  Scan,
  Receipt,
  AlertCircle,
} from "lucide-react"
import Link from "next/link"

export default function PaymentPage() {
  const [selectedService, setSelectedService] = useState("")
  const [amount, setAmount] = useState("")
  const [reference, setReference] = useState("")
  const [showQRScanner, setShowQRScanner] = useState(false)

  const billServices = [
    { id: "electricity", name: "CIE (Électricité)", icon: Zap, color: "bg-yellow-500" },
    { id: "water", name: "SODECI (Eau)", icon: Droplets, color: "bg-blue-500" },
    { id: "phone", name: "Facture Téléphone", icon: Phone, color: "bg-green-500" },
    { id: "internet", name: "Internet/TV", icon: Wifi, color: "bg-purple-500" },
  ]

  const merchantServices = [
    { id: "transport", name: "Transport", icon: Car, color: "bg-orange-500" },
    { id: "shopping", name: "Commerce", icon: ShoppingBag, color: "bg-pink-500" },
    { id: "restaurant", name: "Restaurant", icon: Receipt, color: "bg-red-500" },
  ]

  const recentPayments = [
    {
      id: 1,
      service: "CIE (Électricité)",
      reference: "123456789",
      amount: 15000,
      date: "Aujourd'hui 10:30",
      status: "completed",
    },
    {
      id: 2,
      service: "SODECI (Eau)",
      reference: "987654321",
      amount: 8500,
      date: "Hier 14:20",
      status: "completed",
    },
    {
      id: 3,
      service: "Restaurant Le Palmier",
      reference: "QR-001234",
      amount: 12000,
      date: "2 jours",
      status: "completed",
    },
  ]

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <header className="bg-white shadow-sm border-b">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex items-center h-16">
            <Button variant="ghost" size="icon" asChild>
              <Link href="/dashboard">
                <ArrowLeft className="h-5 w-5" />
              </Link>
            </Button>
            <h1 className="ml-4 text-xl font-semibold text-gray-900">Paiements</h1>
          </div>
        </div>
      </header>

      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <Tabs defaultValue="bills" className="space-y-6">
          <TabsList className="grid w-full grid-cols-3">
            <TabsTrigger value="bills">Factures</TabsTrigger>
            <TabsTrigger value="merchants">Marchands</TabsTrigger>
            <TabsTrigger value="qr">QR Code</TabsTrigger>
          </TabsList>

          {/* Bills Tab */}
          <TabsContent value="bills" className="space-y-6">
            <Card>
              <CardHeader>
                <CardTitle className="flex items-center space-x-2">
                  <Receipt className="h-5 w-5" />
                  <span>Paiement de factures</span>
                </CardTitle>
                <CardDescription>Payez vos factures d'électricité, d'eau, de téléphone et internet</CardDescription>
              </CardHeader>
              <CardContent className="space-y-6">
                {/* Service Selection */}
                <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                  {billServices.map((service) => (
                    <div
                      key={service.id}
                      className={`flex flex-col items-center p-4 rounded-lg border cursor-pointer transition-colors ${
                        selectedService === service.id ? "border-blue-500 bg-blue-50" : "hover:bg-gray-50"
                      }`}
                      onClick={() => setSelectedService(service.id)}
                    >
                      <div className={`w-12 h-12 ${service.color} rounded-full flex items-center justify-center mb-3`}>
                        <service.icon className="h-6 w-6 text-white" />
                      </div>
                      <span className="text-sm font-medium text-center">{service.name}</span>
                    </div>
                  ))}
                </div>

                {selectedService && (
                  <div className="space-y-4 p-4 bg-gray-50 rounded-lg">
                    <div className="space-y-2">
                      <Label htmlFor="reference">Numéro de référence</Label>
                      <Input
                        id="reference"
                        placeholder="Entrez votre numéro de compteur/contrat"
                        value={reference}
                        onChange={(e) => setReference(e.target.value)}
                      />
                    </div>
                    <div className="space-y-2">
                      <Label htmlFor="amount">Montant (FCFA)</Label>
                      <Input
                        id="amount"
                        type="number"
                        placeholder="Montant à payer"
                        value={amount}
                        onChange={(e) => setAmount(e.target.value)}
                      />
                    </div>
                    <Button className="w-full" disabled={!reference || !amount}>
                      Vérifier et payer
                    </Button>
                  </div>
                )}
              </CardContent>
            </Card>
          </TabsContent>

          {/* Merchants Tab */}
          <TabsContent value="merchants" className="space-y-6">
            <Card>
              <CardHeader>
                <CardTitle className="flex items-center space-x-2">
                  <ShoppingBag className="h-5 w-5" />
                  <span>Paiement marchands</span>
                </CardTitle>
                <CardDescription>Payez dans les commerces, restaurants et services partenaires</CardDescription>
              </CardHeader>
              <CardContent className="space-y-6">
                {/* Merchant Categories */}
                <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                  {merchantServices.map((service) => (
                    <div
                      key={service.id}
                      className="flex items-center space-x-4 p-4 border rounded-lg hover:bg-gray-50 cursor-pointer"
                    >
                      <div className={`w-12 h-12 ${service.color} rounded-full flex items-center justify-center`}>
                        <service.icon className="h-6 w-6 text-white" />
                      </div>
                      <div>
                        <h3 className="font-semibold">{service.name}</h3>
                        <p className="text-sm text-gray-600">Paiement sécurisé</p>
                      </div>
                    </div>
                  ))}
                </div>

                {/* Popular Merchants */}
                <div>
                  <h3 className="font-semibold mb-4">Marchands populaires</h3>
                  <div className="space-y-3">
                    {[
                      { name: "Restaurant Le Palmier", category: "Restaurant", discount: "5%" },
                      { name: "Supermarché Citydia", category: "Commerce", discount: "2%" },
                      { name: "Station Shell", category: "Carburant", discount: "3%" },
                      { name: "Pharmacie du Plateau", category: "Santé", discount: "0%" },
                    ].map((merchant, index) => (
                      <div key={index} className="flex items-center justify-between p-3 border rounded-lg">
                        <div>
                          <p className="font-medium">{merchant.name}</p>
                          <p className="text-sm text-gray-600">{merchant.category}</p>
                        </div>
                        <div className="text-right">
                          {merchant.discount !== "0%" && (
                            <Badge className="bg-green-100 text-green-800">-{merchant.discount}</Badge>
                          )}
                        </div>
                      </div>
                    ))}
                  </div>
                </div>
              </CardContent>
            </Card>
          </TabsContent>

          {/* QR Code Tab */}
          <TabsContent value="qr" className="space-y-6">
            <Card>
              <CardHeader>
                <CardTitle className="flex items-center space-x-2">
                  <QrCode className="h-5 w-5" />
                  <span>Paiement par QR Code</span>
                </CardTitle>
                <CardDescription>Scannez un QR code pour payer rapidement</CardDescription>
              </CardHeader>
              <CardContent className="space-y-6">
                {!showQRScanner ? (
                  <div className="text-center py-12">
                    <div className="w-24 h-24 bg-gray-200 rounded-lg mx-auto mb-6 flex items-center justify-center">
                      <Scan className="h-12 w-12 text-gray-400" />
                    </div>
                    <h3 className="text-lg font-semibold mb-2">Scanner un QR Code</h3>
                    <p className="text-gray-600 mb-6">
                      Pointez votre caméra vers le QR code du marchand pour effectuer un paiement rapide
                    </p>
                    <Button onClick={() => setShowQRScanner(true)} className="w-full max-w-sm">
                      <Scan className="h-4 w-4 mr-2" />
                      Ouvrir le scanner
                    </Button>
                  </div>
                ) : (
                  <div className="text-center py-8">
                    <div className="w-64 h-64 bg-black rounded-lg mx-auto mb-4 flex items-center justify-center">
                      <div className="text-white text-center">
                        <Scan className="h-16 w-16 mx-auto mb-2" />
                        <p className="text-sm">Scanner actif...</p>
                      </div>
                    </div>
                    <p className="text-gray-600 mb-4">Positionnez le QR code dans le cadre</p>
                    <Button variant="outline" onClick={() => setShowQRScanner(false)}>
                      Fermer le scanner
                    </Button>
                  </div>
                )}

                {/* Manual QR Entry */}
                <div className="border-t pt-6">
                  <h3 className="font-semibold mb-4">Saisie manuelle</h3>
                  <div className="space-y-4">
                    <div className="space-y-2">
                      <Label htmlFor="qrCode">Code QR ou ID marchand</Label>
                      <Input id="qrCode" placeholder="Entrez le code manuellement" />
                    </div>
                    <Button variant="outline" className="w-full">
                      Valider le code
                    </Button>
                  </div>
                </div>
              </CardContent>
            </Card>
          </TabsContent>
        </Tabs>

        {/* Recent Payments */}
        <Card>
          <CardHeader>
            <div className="flex justify-between items-center">
              <CardTitle>Paiements récents</CardTitle>
              <Button variant="outline" size="sm" asChild>
                <Link href="/history">Voir tout</Link>
              </Button>
            </div>
          </CardHeader>
          <CardContent>
            <div className="space-y-4">
              {recentPayments.map((payment) => (
                <div key={payment.id} className="flex items-center justify-between p-4 border rounded-lg">
                  <div className="flex items-center space-x-4">
                    <div className="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                      <CreditCard className="h-5 w-5 text-purple-600" />
                    </div>
                    <div>
                      <p className="font-medium">{payment.service}</p>
                      <p className="text-sm text-gray-500">
                        Réf: {payment.reference} • {payment.date}
                      </p>
                    </div>
                  </div>
                  <div className="text-right">
                    <p className="font-semibold text-purple-600">-{payment.amount.toLocaleString()} FCFA</p>
                    <Badge className="bg-green-100 text-green-800">Payé</Badge>
                  </div>
                </div>
              ))}
            </div>
          </CardContent>
        </Card>

        {/* Payment Tips */}
        <Card>
          <CardContent className="pt-6">
            <div className="bg-blue-50 border border-blue-200 rounded-lg p-4">
              <div className="flex items-start space-x-3">
                <AlertCircle className="h-5 w-5 text-blue-600 mt-0.5" />
                <div className="text-sm">
                  <p className="font-medium text-blue-800 mb-2">Conseils pour vos paiements</p>
                  <ul className="text-blue-700 space-y-1">
                    <li>• Vérifiez toujours les informations avant de confirmer</li>
                    <li>• Conservez vos reçus de paiement</li>
                    <li>• Bénéficiez de réductions chez nos partenaires</li>
                    <li>• Utilisez le QR code pour des paiements plus rapides</li>
                  </ul>
                </div>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  )
}
