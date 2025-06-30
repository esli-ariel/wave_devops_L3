"use client"

import { useState } from "react"
import { Button } from "@/components/ui/button"
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Avatar, AvatarFallback } from "@/components/ui/avatar"
import { Badge } from "@/components/ui/badge"
import { ArrowLeft, Send, Users, Phone, DollarSign, AlertCircle, QrCode } from "lucide-react"
import Link from "next/link"

export default function TransferPage() {
  const [step, setStep] = useState(1)
  const [transferData, setTransferData] = useState({
    recipient: "",
    amount: "",
  })

  const frequentContacts = [
    { name: "Aya Marie", phone: "+225 07 XX XX XX XX 01", avatar: "AM" },
    { name: "Koffi Paul", phone: "+225 05 XX XX XX XX 02", avatar: "KP" },
    { name: "Fatou Diallo", phone: "+225 01 XX XX XX XX 03", avatar: "FD" },
  ]

  const handleNext = () => {
    if (step < 3) setStep(step + 1)
  }

  const handleBack = () => {
    if (step > 1) setStep(step - 1)
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
            <h1 className="ml-4 text-xl font-semibold text-gray-900">Envoyer de l'argent</h1>
          </div>
        </div>
      </header>

      <div className="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* Progress Steps */}
        <div className="mb-8">
          <div className="flex items-center justify-center space-x-4">
            {[1, 2, 3].map((stepNumber) => (
              <div key={stepNumber} className="flex items-center">
                <div
                  className={`w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium ${
                    step >= stepNumber ? "bg-blue-600 text-white" : "bg-gray-200 text-gray-600"
                  }`}
                >
                  {stepNumber}
                </div>
                {stepNumber < 3 && (
                  <div className={`w-16 h-1 mx-2 ${step > stepNumber ? "bg-blue-600" : "bg-gray-200"}`} />
                )}
              </div>
            ))}
          </div>
          <div className="flex justify-center mt-4">
            <div className="text-center">
              <p className="text-sm font-medium text-gray-900">
                {step === 1 && "Destinataire"}
                {step === 2 && "Montant"}
                {step === 3 && "Confirmation"}
              </p>
            </div>
          </div>
        </div>

        {/* Step 1: Recipient */}
        {step === 1 && (
          <Card>
            <CardHeader>
              <CardTitle className="flex items-center space-x-2">
                <Users className="h-5 w-5" />
                <span>Choisir le destinataire</span>
              </CardTitle>
              <CardDescription>Sélectionnez un contact ou entrez un nouveau numéro</CardDescription>
            </CardHeader>
            <CardContent className="space-y-6">
              {/* Manual Entry */}
              <div className="space-y-2">
                <Label htmlFor="recipient">Numéro de téléphone</Label>
                <div className="relative">
                  <Phone className="absolute left-3 top-3 h-4 w-4 text-gray-400" />
                  <Input
                    id="recipient"
                    placeholder="+225 XX XX XX XX XX"
                    className="pl-10"
                    value={transferData.recipient}
                    onChange={(e) => setTransferData({ ...transferData, recipient: e.target.value })}
                  />
                </div>
              </div>

              {/* Frequent Contacts */}
              <div>
                <Label className="text-sm font-medium text-gray-700 mb-3 block">Contacts fréquents</Label>
                <div className="space-y-2">
                  {frequentContacts.map((contact, index) => (
                    <div
                      key={index}
                      className={`flex items-center space-x-3 p-3 border rounded-lg cursor-pointer transition-colors ${
                        transferData.recipient === contact.phone ? "border-blue-500 bg-blue-50" : "hover:bg-gray-50"
                      }`}
                      onClick={() => setTransferData({ ...transferData, recipient: contact.phone })}
                    >
                      <Avatar>
                        <AvatarFallback>{contact.avatar}</AvatarFallback>
                      </Avatar>
                      <div className="flex-1">
                        <p className="font-medium">{contact.name}</p>
                        <p className="text-sm text-gray-500">{contact.phone}</p>
                      </div>
                      {transferData.recipient === contact.phone && <Badge>Sélectionné</Badge>}
                    </div>
                  ))}
                </div>
              </div>

              <Button className="w-full" onClick={handleNext} disabled={!transferData.recipient}>
                Continuer
              </Button>
            </CardContent>
          </Card>
        )}

        {/* Step 2: Amount */}
        {step === 2 && (
          <Card>
            <CardHeader>
              <CardTitle className="flex items-center space-x-2">
                <DollarSign className="h-5 w-5" />
                <span>Montant à envoyer</span>
              </CardTitle>
              <CardDescription>Entrez le montant et choisissez la méthode de paiement</CardDescription>
            </CardHeader>
            <CardContent className="space-y-6">
              <div className="space-y-2">
                <Label htmlFor="amount">Montant (FCFA)</Label>
                <Input
                  id="amount"
                  type="number"
                  placeholder="0"
                  className="text-2xl font-bold text-center"
                  value={transferData.amount}
                  onChange={(e) => setTransferData({ ...transferData, amount: e.target.value })}
                />
              </div>

              {/* Quick Amount Buttons */}
              <div>
                <Label className="text-sm font-medium text-gray-700 mb-3 block">Montants rapides</Label>
                <div className="grid grid-cols-3 gap-2">
                  {[5000, 10000, 25000, 50000, 100000, 200000].map((amount) => (
                    <Button
                      key={amount}
                      variant="outline"
                      size="sm"
                      onClick={() => setTransferData({ ...transferData, amount: amount.toString() })}
                    >
                      {amount.toLocaleString()}
                    </Button>
                  ))}
                </div>
              </div>

              {/* QR Code for Agent Transactions */}
              <div className="border-t pt-6">
                <Label className="text-sm font-medium text-gray-700 mb-3 block">Mon QR Code Agent</Label>
                <div className="bg-blue-50 p-4 rounded-lg">
                  <div className="flex items-center space-x-4">
                    <div className="w-20 h-20 bg-white border-2 border-blue-200 rounded-lg flex items-center justify-center">
                      <QrCode className="h-12 w-12 text-blue-600" />
                    </div>
                    <div className="flex-1">
                      <p className="font-medium text-blue-900">Code pour les agents</p>
                      <p className="text-sm text-blue-700">
                        Faites scanner ce code par un agent Wave pour effectuer un dépôt ou un retrait sur votre compte
                      </p>
                      <p className="text-xs text-blue-600 mt-1">
                        ID: WV-{Math.random().toString(36).substr(2, 8).toUpperCase()}
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div className="flex space-x-4">
                <Button variant="outline" onClick={handleBack} className="flex-1">
                  Retour
                </Button>
                <Button onClick={handleNext} className="flex-1" disabled={!transferData.amount}>
                  Continuer
                </Button>
              </div>
            </CardContent>
          </Card>
        )}

        {/* Step 3: Confirmation */}
        {step === 3 && (
          <Card>
            <CardHeader>
              <CardTitle className="flex items-center space-x-2">
                <Send className="h-5 w-5" />
                <span>Confirmer le transfert</span>
              </CardTitle>
              <CardDescription>Vérifiez les détails avant d'envoyer</CardDescription>
            </CardHeader>
            <CardContent className="space-y-6">
              {/* Transfer Summary */}
              <div className="bg-gray-50 p-4 rounded-lg space-y-4">
                <div className="flex justify-between">
                  <span className="text-gray-600">Destinataire</span>
                  <span className="font-medium">{transferData.recipient}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-gray-600">Montant</span>
                  <span className="font-bold text-lg">
                    {Number.parseInt(transferData.amount).toLocaleString()} FCFA
                  </span>
                </div>
                <div className="flex justify-between">
                  <span className="text-gray-600">Frais</span>
                  <span className="font-medium">0 FCFA</span>
                </div>
                <div className="border-t pt-2">
                  <div className="flex justify-between">
                    <span className="font-semibold">Total</span>
                    <span className="font-bold text-lg">
                      {Number.parseInt(transferData.amount).toLocaleString()} FCFA
                    </span>
                  </div>
                </div>
              </div>

              {/* Warning */}
              <div className="flex items-start space-x-3 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <AlertCircle className="h-5 w-5 text-yellow-600 mt-0.5" />
                <div className="text-sm">
                  <p className="font-medium text-yellow-800">Attention</p>
                  <p className="text-yellow-700">
                    Assurez-vous que le numéro du destinataire est correct. Cette transaction ne peut pas être annulée.
                  </p>
                </div>
              </div>

              <div className="flex space-x-4">
                <Button variant="outline" onClick={handleBack} className="flex-1">
                  Modifier
                </Button>
                <Button className="flex-1 bg-green-600 hover:bg-green-700">Confirmer l'envoi</Button>
              </div>
            </CardContent>
          </Card>
        )}
      </div>
    </div>
  )
}
