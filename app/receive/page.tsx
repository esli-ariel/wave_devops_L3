"use client"

import { useState } from "react"
import { Button } from "@/components/ui/button"
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Badge } from "@/components/ui/badge"
import { ArrowLeft, QrCode, Copy, Share, Phone, DollarSign, AlertCircle } from "lucide-react"
import Link from "next/link"

export default function ReceivePage() {
  const [requestAmount, setRequestAmount] = useState("")
  const [showQR, setShowQR] = useState(false)

  const myNumber = "+225 07 XX XX XX XX"

  const handleCopyNumber = () => {
    navigator.clipboard.writeText(myNumber)
    // You could add a toast notification here
  }

  const handleShareNumber = () => {
    if (navigator.share) {
      navigator.share({
        title: "Mon numéro Wave",
        text: `Envoyez-moi de l'argent sur Wave: ${myNumber}`,
      })
    }
  }

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
            <h1 className="ml-4 text-xl font-semibold text-gray-900">Recevoir de l'argent</h1>
          </div>
        </div>
      </header>

      <div className="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
        {/* My Number Card */}
        <Card>
          <CardHeader>
            <CardTitle className="flex items-center space-x-2">
              <Phone className="h-5 w-5" />
              <span>Mon numéro Wave</span>
            </CardTitle>
            <CardDescription>Partagez ce numéro pour recevoir de l'argent</CardDescription>
          </CardHeader>
          <CardContent className="space-y-4">
            <div className="text-center p-6 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg text-white">
              <p className="text-sm opacity-90 mb-2">Mon numéro</p>
              <p className="text-2xl font-bold tracking-wider">{myNumber}</p>
            </div>

            <div className="flex space-x-2">
              <Button variant="outline" onClick={handleCopyNumber} className="flex-1">
                <Copy className="h-4 w-4 mr-2" />
                Copier
              </Button>
              <Button variant="outline" onClick={handleShareNumber} className="flex-1">
                <Share className="h-4 w-4 mr-2" />
                Partager
              </Button>
            </div>
          </CardContent>
        </Card>

        {/* QR Code Card */}
        <Card>
          <CardHeader>
            <CardTitle className="flex items-center space-x-2">
              <QrCode className="h-5 w-5" />
              <span>Code QR</span>
            </CardTitle>
            <CardDescription>Faites scanner ce code pour recevoir de l'argent</CardDescription>
          </CardHeader>
          <CardContent className="space-y-4">
            {!showQR ? (
              <div className="text-center py-8">
                <div className="w-24 h-24 bg-gray-200 rounded-lg mx-auto mb-4 flex items-center justify-center">
                  <QrCode className="h-12 w-12 text-gray-400" />
                </div>
                <Button onClick={() => setShowQR(true)}>Générer le code QR</Button>
              </div>
            ) : (
              <div className="text-center">
                <div className="w-48 h-48 bg-white border-2 border-gray-200 rounded-lg mx-auto mb-4 flex items-center justify-center">
                  {/* QR Code would be generated here */}
                  <div className="text-center">
                    <QrCode className="h-24 w-24 text-gray-400 mx-auto mb-2" />
                    <p className="text-xs text-gray-500">Code QR généré</p>
                  </div>
                </div>
                <p className="text-sm text-gray-600 mb-4">Faites scanner ce code par l'expéditeur</p>
                <Button variant="outline" onClick={() => setShowQR(false)}>
                  Masquer le code
                </Button>
              </div>
            )}
          </CardContent>
        </Card>

        {/* Agent QR Code Card */}
        <Card>
          <CardHeader>
            <CardTitle className="flex items-center space-x-2">
              <QrCode className="h-5 w-5 text-orange-600" />
              <span>QR Code Agent</span>
            </CardTitle>
            <CardDescription>Code spécial pour les dépôts et retraits avec les agents Wave</CardDescription>
          </CardHeader>
          <CardContent className="space-y-4">
            <div className="bg-orange-50 p-6 rounded-lg border border-orange-200">
              <div className="flex items-center space-x-4">
                <div className="w-24 h-24 bg-white border-2 border-orange-300 rounded-lg flex items-center justify-center">
                  <QrCode className="h-16 w-16 text-orange-600" />
                </div>
                <div className="flex-1">
                  <h3 className="font-semibold text-orange-900 mb-2">Code Agent Personnel</h3>
                  <p className="text-sm text-orange-700 mb-2">Présentez ce code à un agent Wave pour :</p>
                  <ul className="text-sm text-orange-700 space-y-1">
                    <li>• Effectuer un dépôt sur votre compte</li>
                    <li>• Faire un retrait d'espèces</li>
                    <li>• Vérifier votre identité</li>
                  </ul>
                  <div className="mt-3 p-2 bg-white rounded border">
                    <p className="text-xs font-mono text-gray-600">
                      ID: WV-{Math.random().toString(36).substr(2, 8).toUpperCase()}
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div className="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
              <div className="flex items-start space-x-3">
                <AlertCircle className="h-5 w-5 text-yellow-600 mt-0.5" />
                <div className="text-sm">
                  <p className="font-medium text-yellow-800">Important</p>
                  <p className="text-yellow-700">
                    Ne partagez ce code qu'avec des agents Wave officiels. Vérifiez toujours l'identité de l'agent avant
                    toute transaction.
                  </p>
                </div>
              </div>
            </div>
          </CardContent>
        </Card>

        {/* Request Money Card */}
        <Card>
          <CardHeader>
            <CardTitle className="flex items-center space-x-2">
              <DollarSign className="h-5 w-5" />
              <span>Demander un montant</span>
            </CardTitle>
            <CardDescription>Créez une demande de paiement avec un montant spécifique</CardDescription>
          </CardHeader>
          <CardContent className="space-y-4">
            <div className="space-y-2">
              <Label htmlFor="requestAmount">Montant demandé (FCFA)</Label>
              <Input
                id="requestAmount"
                type="number"
                placeholder="Entrez le montant"
                value={requestAmount}
                onChange={(e) => setRequestAmount(e.target.value)}
              />
            </div>

            {/* Quick Amount Buttons */}
            <div>
              <Label className="text-sm font-medium text-gray-700 mb-3 block">Montants rapides</Label>
              <div className="grid grid-cols-3 gap-2">
                {[5000, 10000, 25000, 50000, 100000, 200000].map((amount) => (
                  <Button key={amount} variant="outline" size="sm" onClick={() => setRequestAmount(amount.toString())}>
                    {amount.toLocaleString()}
                  </Button>
                ))}
              </div>
            </div>

            <Button className="w-full" disabled={!requestAmount}>
              Créer la demande
            </Button>
          </CardContent>
        </Card>

        {/* Recent Requests */}
        <Card>
          <CardHeader>
            <CardTitle>Demandes récentes</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="space-y-3">
              {[
                { amount: 50000, from: "Aya Marie", status: "pending", date: "Il y a 2h" },
                { amount: 25000, from: "Koffi Paul", status: "completed", date: "Hier" },
                { amount: 15000, from: "Fatou Diallo", status: "expired", date: "Il y a 3 jours" },
              ].map((request, index) => (
                <div key={index} className="flex items-center justify-between p-3 border rounded-lg">
                  <div>
                    <p className="font-medium">{request.amount.toLocaleString()} FCFA</p>
                    <p className="text-sm text-gray-500">
                      de {request.from} • {request.date}
                    </p>
                  </div>
                  <Badge
                    variant={
                      request.status === "completed"
                        ? "default"
                        : request.status === "pending"
                          ? "secondary"
                          : "destructive"
                    }
                  >
                    {request.status === "completed" ? "Reçu" : request.status === "pending" ? "En attente" : "Expiré"}
                  </Badge>
                </div>
              ))}
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  )
}
